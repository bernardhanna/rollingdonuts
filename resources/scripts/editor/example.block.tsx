import { __ } from "@wordpress/i18n";

/* Block name */
export const name = `example/example-block-a`

/* Block title */
export const title = __(`Example block`, `rollingdonuts`)

/* Block category */
export const category = `text`

/* Block edit */
export const edit = () => <></>

/* Block save */
export const save = () => <></>

/* Block styles */
export const styles = [
  { name: `default`, label: __(`Default`, `rollingdonuts`), isDefault: true },
  { name: `custom`, label: __(`Custom`, `rollingdonuts`) },
]

/* Block variations */
export const variations = [
  { name: `example/example-block-b`, title: __(`Example block variant`, `rollingdonuts`) },
]
