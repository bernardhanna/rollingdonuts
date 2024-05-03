git checkout develop
git add .           
git commit -am "03-05-2024"
git push

git checkout main   
git pull origin main        
git merge develop

====================
Digital Ocean
====================

git config --global user.email "bernard@matrixinternet.ie"
git config --global user.name "bernardhanna"land
cd /var/www/
sudo chown -R www-data:www-data html
cd /var/www/html

git checkout main
git add .
git commit -m "Image folder fix"
git pull
yarn build
cd /var/www/
sudo chown -R www-data:www-data html
v=spf1 ip4:159.223.211.112_ip ~all
