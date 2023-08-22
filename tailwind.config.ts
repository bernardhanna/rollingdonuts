/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-10 13:03:37
 */
import type { Config } from 'tailwindcss';
import forms from '@tailwindcss/forms';

export default {
  content: [
    './app/**/*.php',
    './resources/**/*.{php,js,ts,tsx,vue,html,blade.php}',
    './resources/views/**/*.php',
    './public/content/themes/rollingdonuts/index.php',
  ],
  theme: {
    colors: {
      inherit: 'inherit',
      current: 'currentColor',
      transparent: 'transparent',
      black: {
        secondary: '#2d2a2a',
        primary: '#291f19',
        full: '#000000',
        font: '#252525',
      },
      yellow: {
        primary: '#ffed56',
        secondary: '#f3ea5d',
        hovered: '#fff6a7',
        depressed: '#f1da1a',
        alert: '#f5f951',
        disabled: '#d8d7ce',
      },
      white: '#ffffff',
      grey: {
        subdued: '#484848',
        disabled: '#e1e1e1',
        background: '#FAFAFA',
      },
      green: {
        success: '#59e456',
      },
      blue: {
        highlight: '#65c2f6',
      },
      red: {
        critical: '#f55959',
      },
    },
    fontFamily: {
      'edmondsans': ['"Edmondsans"', 'sans-serif'],
      'laca': ['"Laca"', 'sans-serif'],
    },
    fontSize: {
      'xxxl-font': '64px',
      'xxl-font': '56px',
      'xl-font': '48px',
      'lg-font': '40px',
      '1lg-font': '36px',
      'md-font': '32px',
      'font-28': '28px',
      'sm-md-font': '24px',
      'reg-font': '20px',
      'base-font': '18px',
      'sm-font': '16px',
      'xs-font': '1em',
      'xxs-font': '12px',
      'mob-xxl-font': '40px',
      'mob-xl-font': '32px',
      'mob-lg-font': '24px',
      'mob-md-font': '20px',
      'mob-sm-font': '16px',
      'mob-xs-font': '14px',
      'mob-xxs-font': '12px',
    },
    fontWeight: {
      lighter: '300',
      light: '350',
      regular: '400',
      reg420: '420',
      medium: '410',
      bold: '420',
      bolder: '700',
    },
    screens: {
      'xs': '320px',
      'sm': '640px',
      'md': '768px',
      'lg': '1084px',
      'xl': '1280px',
      'xxl': '1440px',
      'xxxl': '1920px',
      'xxxxl': '2500px',
      'xxxxxl': '2750px',
    },
    letterSpacing: {
      widest: '0.17em'
    },
    lineHeight: {
      '3xl': '3rem',
    },
    borderRadius: {
      'none': '0',
      'sm': '0.125rem',
      DEFAULT: '0.25rem',
      'md': '0.375rem',
      'lg-x': '4.5rem',
      'large': '8.25rem',
      'full': '100%',
    },
    extend: {
      screens: {
        'lg' : '1085px',
        'one-xl': '1600px',
      },
      zIndex: {
        '99': '99',
      },
      height: {
        'input': '3.5rem',
        '40': '40px',
        '80': '32rem',
        '500px' : '31.25rem',
        'hero-28': '28rem',
        'hero-height' : '43.625rem',
        'hero-mob': '50vh',
      },
      width: {
        'inherit': 'inherit',
        '22pc' : '22%',
        '70pc' : '70%',
        '22.28': '22.28px',
        '41.6': '41.6px',
        '256' : '256px',
        'heroleft': '56%',
        'heroright': '44%',
      },
      maxWidth: {
        'max-128': '6rem', //126px
        'max-242': '15.125rem', //242px
        'max-256': '16rem', //256px
        'max-322': '20.125rem', //322px
        'max-358': '22.375rem', //358px
        'max-368': '23rem', //368px
        'max-474': '29.625rem', //474px
        'max-478': '29.875rem', //478px
        'max-504': '31.5rem', //504px
        'max-573': '35.8125rem', //573px
        'max-750': '46.875rem', //750px
        'max-529': '33.0625rem', //529px
        'max-1514': '94.625rem', //1514px
        'max-1549': '96.8125rem', //1549px
        'max-1568': '98rem', //1568px
        'sitewidth': '107.875rem', //1726px
        'max-95': '95%', //95%
      },
      maxHeight: {
        'max-125': '7.813rem', //175px
        'max-300': '18.75rem', //300px
        'max-386': '24.125rem', //386px
        'max-473': '29.5625rem', //473px
        'max-504': '31.5rem', //504px
        'max-645': '40.3125rem', //645px
        'max-800': '50rem', //800px
        'max-984': '61.5rem', //984px
      },
      borderWidth: {
        '3': '3px',
      },
      borderRadius: {
        'sm-8': '8px',
        'sm-10': '10px',
        'btn-72': '72px',
        '1': '1px',
        '3': '3px',
        '113xl': '132px',
        '3xs': '10px',
        '20px': '20px',
        '26xl': '45px',
        '61xl': '80px',
        '31xl': '50px',
        '181xl': '200px',
        '8xs': '5px',
        '2xs': '10px',
        '2xs-7': '10.7px',
        '34xl-5': '53.5px',
        '74xl-7': '93.7px',
      },
    }
  },
  variants: {
    extend: {
      textColor: ['hover'],
    },
    fill: ['hover', 'focus'],
  },
  plugins: [
    forms,
  ],
} satisfies Config;
