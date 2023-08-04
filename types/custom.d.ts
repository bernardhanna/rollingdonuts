/**
 * Idiosyncratic webpack typings
 *
 * @see {@link https://webpack.js.org/guides/typescript/#importing-other-assets}
 */

import type { Alpine } from 'alpinejs'

declare module "*.css"
declare module "*.svg"
declare module "*.jpeg"
declare module "*.jpg"
declare module "*.png"
declare module "*.gif"
declare module "*.webp"

declare global {
  interface Window {
    Alpine: Alpine;
  }

  const roots: {
    register: {
      blocks: (path: string) => void;
      formats: (path: string) => void;
      variations: (path: string) => void;
      plugins: (path: string) => void;
    }
  }
}
