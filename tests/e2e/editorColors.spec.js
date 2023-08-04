import { test, expect } from '@playwright/test';
import { login } from './helpers/loginHelper.js';

test('editor color indigo-100 exists', async ({ page }) => {
  await login(page);
  await page.goto('/wp/wp-admin/post-new.php');
  await page.click('[aria-label="Add block"]');
  await page.click('[aria-label="Blocks"] button.editor-block-list-item-paragraph');
  await page.fill('.editor-styles-wrapper p', 'Example text');
  await page.click('button.block-editor-panel-color-gradient-settings__dropdown div[title="Text"]');
  await page.click('[aria-label="Color: Indigo 100"]');
  const paragraph = await page.$('.editor-styles-wrapper p');
  expect(await paragraph?.getAttribute('style')).toContain('color: rgb(224, 231, 255);');
});
