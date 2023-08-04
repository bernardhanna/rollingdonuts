/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-04 20:51:33
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-04 20:51:47
 */
import { test, expect } from '@playwright/test';
import { login } from './helpers/loginHelper.js';

test('topbar link opens correct URL', async ({ page }) => {
  await login(page);
  await page.goto('https://rollingdonuts.lndo.site/');

  // Click the topbar link
  await page.click('.topbar a');

  // Check if the current URL is correct
  expect(page.url()).toBe('https://rollingdonuts.lndo.site/#');
});
