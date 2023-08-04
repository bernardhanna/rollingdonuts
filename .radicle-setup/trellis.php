<?php

// Find out the latest Trellis release
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.github.com/repos/roots/trellis/releases');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'rollingdonuts');
$releases = json_decode(curl_exec($ch), true);
curl_close($ch);

// Download $releases[0]['zipball_url'] with curl and save it to .rollingdonuts-setup/trellis.zip
curl_setopt($ch, CURLOPT_URL, $releases[0]['zipball_url']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'rollingdonuts');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$zip = curl_exec($ch);
curl_close($ch);
file_put_contents('.rollingdonuts-setup/trellis.zip', $zip);
if (curl_error($ch)) {
    echo curl_error($ch);
}

// Unzip .rollingdonuts-setup/trellis.zip to trellis/
$zip = new ZipArchive();
if ($zip->open('.rollingdonuts-setup/trellis.zip') === true) {
    $name = $zip->getNameIndex(0);
    $zip->extractTo('.');
    rename($name, 'trellis');
    $zip->close();
} else {
    echo 'Unable to extract the latest Trellis release to the trellis/ directory.';
    exit(1);
}

// Delete .rollingdonuts-setup/trellis.zip
unlink('.rollingdonuts-setup/trellis.zip');

// In trellis/group_vars/all/main.yml, add the following after `max_journal_size: 512M`:
// wp_cli_packages:
// - aaemnnosttv/wp-cli-login-command
$groupVarsAllMain = file_get_contents('trellis/group_vars/all/main.yml');
$groupVarsAllMain = str_replace(
    "max_journal_size: 512M",
    "max_journal_size: 512M \n\nwp_cli_packages:\n  - aaemnnosttv/wp-cli-login-command",
    $groupVarsAllMain
);
file_put_contents('trellis/group_vars/all/main.yml', $groupVarsAllMain);

// Vagrantfile: Set `/ansible-nfs` to `rsync` instead of `nfs`
$vagrantfile = file_get_contents('trellis/Vagrantfile');
$vagrantfile = str_replace(
    "config.vm.synced_folder ANSIBLE_PATH, '/ansible-nfs', type: 'nfs'",
    "config.vm.synced_folder ANSIBLE_PATH, '/ansible-nfs', type: 'rsync'",
    $vagrantfile
);
file_put_contents('trellis/Vagrantfile', $vagrantfile);

// group_vars/all/helpers.yml
// Add `acorn_enable_expirimental_router: true` to the `wordpress_env_defaults` array
$groupVarsAllHelpers = file_get_contents('trellis/group_vars/all/helpers.yml');
$groupVarsAllHelpers = str_replace(
    "wordpress_env_defaults:",
    "wordpress_env_defaults:\n  acorn_enable_expirimental_router: true",
    $groupVarsAllHelpers
);
file_put_contents('trellis/group_vars/all/helpers.yml', $groupVarsAllHelpers);

// Overwrite `trellis/deploy-hooks/build-after.yml` with `.rollingdonuts-setup/trellis/build-after.yml`
// Overwrite `trellis/deploy-hooks/build-before.yml` with `.rollingdonuts-setup/trellis/build-before.yml`
copy('.rollingdonuts-setup/trellis/build-after.yml', 'trellis/deploy-hooks/build-after.yml');
copy('.rollingdonuts-setup/trellis/build-before.yml', 'trellis/deploy-hooks/build-before.yml');

// In the following files:
// - group_vars/development/wordpress_sites.yml
// - group_vars/staging/wordpress_sites.yml
// - group_vars/production/wordpress_sites.yml
//
// Replace: `local_path: ../site` with `local_path: ..`
// After `local_path`, add two new lines with four spaces in front of them:
// `public_path: public`
// `upload_path: content/uploads`
//
// Get rid of the entire line: `repo_subtree_path: site # relative path to your Bedrock/WP directory in your repo`
$wordpressSites = [
    'group_vars/development/wordpress_sites.yml',
    'group_vars/staging/wordpress_sites.yml',
    'group_vars/production/wordpress_sites.yml',
];
foreach ($wordpressSites as $file) {
    $content = file_get_contents('trellis/' . $file);
    $content = str_replace(
        "local_path: ../site # path targeting local Bedrock site directory (relative to Ansible root)",
        "local_path: ..\n    public_path: public\n    upload_path: content/uploads",
        $content
    );
    $content = preg_replace(
        "/\s+repo_subtree_path: site # relative path to your Bedrock\/WP directory in your repo/",
        '',
        $content
    );

    file_put_contents('trellis/' . $file, $content);
}

// Replace `192.168.56.5` with `192.168.56.8` in:
// - trellis/hosts/development
// - trellis/vagrant.default.yml
$localIps = [
    'hosts/development',
    'vagrant.default.yml',
];
foreach ($localIps as $file) {
    $content = file_get_contents('trellis/' . $file);
    $content = str_replace('192.168.56.5', '192.168.56.8', $content);
    file_put_contents('trellis/' . $file, $content);
}

// Prompt the user and ask if they would like to replace `example.com` with their domain name
echo 'What domain name should Trellis be configured for? (e.g. example.com): ';
$domain = trim(fgets(STDIN));

// In the following files:
// - group_vars/development/wordpress_sites.yml
// - group_vars/development/vault.yml
// - group_vars/staging/wordpress_sites.yml
// - group_vars/staging/vault.yml
// - group_vars/production/wordpress_sites.yml
// - group_vars/production/vault.yml
//
// Replace: `example.com` with `$domain`
//
// In group_vars/development/wordpress_sites.yml`
// Replace: `example.test` with `$domain.test`, but first strip the extension from `$domain`
$wordpressSitesAndVaults = [
    'group_vars/development/wordpress_sites.yml',
    'group_vars/development/vault.yml',
    'group_vars/staging/wordpress_sites.yml',
    'group_vars/staging/vault.yml',
    'group_vars/production/wordpress_sites.yml',
    'group_vars/production/vault.yml',
];
foreach ($wordpressSitesAndVaults as $file) {
    $content = file_get_contents('trellis/' . $file);
    $content = str_replace('example.com', $domain, $content);
    if ($file === 'group_vars/development/wordpress_sites.yml') {
        $content = str_replace(
            'example.test',
            str_replace('.' . pathinfo($domain, PATHINFO_EXTENSION), '', $domain) . '.test',
            $content
        );
    }

    file_put_contents('trellis/' . $file, $content);
}
