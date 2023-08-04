/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-04 20:57:51
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-04 21:09:40
 */
export async function login(page) {
  await page.goto('/wp/wp-login.php');
  await page.fill('#user_login', 'admin');
  await page.fill('#user_pass', 'admin');
  await page.click('#wp-submit');
  // await page.waitForNavigation();
}
