import { test, expect } from '@playwright/test';

test('footer contains "Designed & Developed by Matrix Internet"', async ({ page }) => {
  await page.goto('/');
  const footer = await page.$('footer');
  expect(await footer?.textContent()).toContain('Designed & Developed by Matrix Internet');
});
