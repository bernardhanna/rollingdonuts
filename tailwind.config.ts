/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-24 12:03:14
 */
import type { Config } from 'tailwindcss';
import forms from "@tailwindcss/forms";
import tailwindcssAnimated from "tailwindcss-animated";

export default {
  content: [
    "./app/**/*.php",
    "./resources/**/*.{php,js,ts,tsx,vue,html,blade.php}",
    "./resources/views/**/*.php",
    "./public/content/themes/rollingdonuts/index.php",
  ],
  theme: {
    colors: {
      inherit: "inherit",
      current: "currentColor",
      transparent: "transparent",
      black: {
        secondary: "#2d2a2a",
        primary: "#291f19",
        full: "#000000",
        font: "#252525",
      },
      yellow: {
        primary: "#ffed56",
        secondary: "#f3ea5d",
        hovered: "#fff6a7",
        depressed: "#f1da1a",
        alert: "#f5f951",
        disabled: "#d8d7ce",
      },
      white: "#ffffff",
      grey: {
        subdued: "#484848",
        disabled: "#e1e1e1",
        background: "#FAFAFA",
        font: "#1F2937",
        border: "#E0E0E0",
        input: "#D8D7CE",
      },
      green: {
        success: "#59e456",
      },
      blue: {
        highlight: "#65c2f6",
      },
      red: {
        critical: "#f55959",
      },
    },
    fontFamily: {
      edmondsans: ['"Edmondsans"', "sans-serif"],
      laca: ['"Laca"', "sans-serif"],
    },
    fontSize: {
      "xxxl-font": "4rem",
      "xxl-font": "56px",
      "xl-font": "48px",
      "lg-font": "2.5rem",
      "1lg-font": "36px",
      "md-font": "32px",
      "font-28": "28px",
      "sm-md-font": "24px",
      "base-font": "18px",
      "reg-font": "1.25rem",
      "sm-font": "16px",
      "xs-font": "1em",
      "xxs-font": "12px",
      "mob-xxl-font": "2.5rem",
      "mob-xl-font": "32px",
      "mob-lg-font": "24px",
      "mob-md-font": "20px",
      "mob-sm-font": "16px",
      "mob-xs-font": "14px",
      "mob-xxs-font": "12px",
      tiny: "10px",
    },
    fontWeight: {
      lighter: "300",
      light: "350",
      regular: "400",
      reg420: "420",
      medium: "410",
      bold: "420",
      bolder: "700",
    },
    screens: {
      xxxs: "220px",
      xs: "320px",
      small: "380px",
      "sm-mob": "480px",
      mobile: "575px",
      sm: "640px",
      md: "768px",
      "tablet-sm": "993px",
      lg: "1085px",
      notebook: "1180px",
      laptop: "1250px",
      xl: "1280px",
      macbook: "1300px",
      xxl: "1440px",
      "insta-flow": "1590px",
      "one-xl": "1600px",
      desktop: "1628px",
      site: "1726px",
      xxxl: "1920px",
      xxxxl: "2500px",
      xxxxxl: "2750px",
    },
    letterSpacing: {
      widest: "0.17em",
    },
    lineHeight: {
      "3xl": "3rem",
    },
    borderRadius: {
      none: "0",
      sm: "0.125rem",
      video: "1.04088rem",
      DEFAULT: "0.25rem",
      md: "0.375rem",
      form: "2.5rem",
      "lg-x": "4.5rem",
      normal: "0.5rem",
      large: "8.25rem",
      full: "100%",
    },
    extend: {
      margin: {
        "2": "0.5rem",
        "25rem": "25rem",
        "64": "16rem",
      },
      boxShadow: {
        small: "0px 8px 0px 0px rgba(0, 0, 0, 0.25)",
      },
      textShadow: {
        medium:
          "2px 2px 0 #000, -2px -2px 0 #000, 2px -2px 0 #000, -2px 2px 0 #000;",
      },
      zIndex: {
        "99": "99",
      },
      height: {
        input: "3.5rem",
        "40": "40px",
        "80": "32rem",
        "492": "30.75rem",
        "500px": "31.25rem",
        "btn-h": "56px",
        "hero-28": "28rem",
        "hero-height": "36.8em",
        "hero-mob": "50vh",
        nav: "165px",
        header: "220px",
      },
      width: {
        inherit: "inherit",
        "22pc": "22%",
        "70pc": "70%",
        "72-5pc": "72.5%",
        "22.28": "22.28px",
        "41.6": "41.6px",
        "256": "256px",
        heroleft: "69%",
        heroright: "44%",
        "23": "23%",
        sidebar: "28.5%",
        "45": "45%",
        "55": "55%",
        "56": "56%",
        "47": "47%",
        "30": "30%",
        "31-5": "31.5%",
        "35": "35%",
        "40": "40%",
        "48": "48%",
        "49": "49%",
        "53": "53%",
        "57": "57%",
        "60": "60%",
        "85": "85%",
        "90": "90%",
      },
      minWidth: {
        "min-208": "208px",
        "min-276": "276px",
      },
      maxWidth: {
        "max-128": "6rem", //126px
        "max-40": "10rem",
        "max-242": "15.125rem", //242px
        "max-256": "16rem", //256px
        "max-322": "20.125rem", //322px
        "max-343": "21.4375rem", //343px''
        "max-358": "22.375rem", //358px
        "max-368": "23rem", //368px
        "max-474": "29.625rem", //474px
        "max-478": "29.875rem", //478px
        "max-504": "31.5rem", //504px
        "max-573": "35.8125rem", //573px
        "max-691": "43.188rem", //691px
        "max-704": "44rem", //704px
        "max-750": "46.875rem", //750px
        "max-503": "31.438rem", //529px
        "max-529": "33.0625rem", //529px
        "max-564": "35.25rem", //564px
        "max-584": "36.5rem", //584px
        "max-848": "53rem", //880px
        "max-1000": "62rem", //1000px
        "max-1038": "64.875rem", //1038px
        "max-1182": "73.875rem", //1182px
        "max-1200": "75rem", //1200px
        "max-1300": "81.25rem", //1300px
        "max-1336": "83.5rem", //1336px
        "max-1359": "84.9375rem", //1359px
        "max-1341": "83.8125rem", //1341px
        "max-1364": "85.25rem", //1364px
        "max-1370": "85.625rem", //1370px
        "max-1405": "87.8125rem", //1405px
        "max-1467": "91.6875rem", //1467px
        "max-1485": "92.8125rem", //1485px
        "max-1504": "94rem", //1504px
        "max-1514": "94.625rem", //1514px
        "max-1549": "96.8125rem", //1549px
        "max-1552": "97rem", //1552px
        "max-1568": "98rem",
        "max-1571": "98.1875rem", //1571px;
        "max-1578": "98.625rem", //1578px
        "max-1584": "99rem", //1584px
        "max-1596": "99.75rem", //1590px
        "max-100": "100rem",
        "max-1616": "101rem", //1616px
        sitewidth: "107.875rem", //1726px
        "max-95": "95%", //95%
      },
      maxHeight: {
        "max-125": "7.813rem", //175px
        "max-300": "18.75rem", //300px
        "max-386": "24.125rem", //386px
        "max-473": "29.5625rem", //473px
        "max-504": "31.5rem", //504px
        "max-645": "40.3125rem", //645px
        "max-800": "50rem", //800px
        "max-984": "61.5rem", //984px
      },
      borderWidth: {
        "3": "3px",
        "12": "12px",
      },
      borderRadius: {
        "left-sides": "0.5rem 0rem 0rem 0.5rem",
        "right-sides": "0rem 0.5rem 0.5rem 0rem",
        "all-sides": "0.5rem 0.5rem 0.5rem 0.5rem",
        "tl-lg": "0.5rem 0.5rem 0rem 0rem",
        one: "1rem",
        "md-20": "20px",
        img: "24px",
        "md-32": "32px",
        "md-40": "40px",
        "sm-8": "8px",
        "sm-10": "10px",
        "sm-12": "12px",
        "btn-72": "72px",
        "1": "1px",
        "3": "3px",
        nornmal: "1.5rem",
        normal: "1.5rem",
        "113xl": "132px",
        "3xs": "10px",
        "20px": "20px",
        "26xl": "45px",
        "61xl": "80px",
        "31xl": "50px",
        "181xl": "200px",
        "6xs": "6px",
        "8xs": "5px",
        "2xs": "10px",
        "2xs-7": "10.7px",
        "34xl-5": "53.5px",
        "74xl-7": "93.7px",
      },
    },
  },
  variants: {
    extend: {
      textColor: ["hover"],
    },
    fill: ["hover", "focus"],
  },
  plugins: [forms, tailwindcssAnimated],
} satisfies Config;
