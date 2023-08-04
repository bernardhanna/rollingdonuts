/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-18 12:14:23
 */
roots.register.blocks(`./editor/`)
roots.register.formats(`./editor/`)
roots.register.variations(`./editor/`)
roots.register.plugins(`./editor/`)

if (import.meta.webpackHot) {
  import.meta.webpackHot.accept(console.error);
}
