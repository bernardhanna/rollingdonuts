import { getBlockTypes, unregisterBlockType } from '@wordpress/blocks';
import { useEffect } from 'react';
import { __ } from "@wordpress/i18n";

/** Plugin name */
export const name = `example-plugin`;

/** Plugin title */
export const title = __(`Example plugin`, `rollingdonuts`);

/** Plugin render */
export const render = () => {
  useEffect(() => {
    // Unregister all blocks that aren't in the text, media, design, or widget categories
    getBlockTypes()
      .filter((block) => ![`text`, `media`, `design`, `widgets`].includes(block?.category))
      .map((block) => block.name)
      .map(unregisterBlockType);
  }, []);

  return null;
};
