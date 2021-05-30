<template>
  <router-link :class="themeClass" :to="{ name: routeName, params}">
    <slot />
  </router-link>
</template>

<script>
const themes = ['cta', 'primary', 'secondary', 'none', 'icon']
const colours = ['primary', 'secondary']

export default {
  name: 'Anchor',
  props: {
    routeName: {
      type: String,
      required: true
    },
    params: {
      type: Object,
      default: () => {}
    },
    theme: {
      type: String,
      required: false,
      default: 'primary',
      validator: value => themes.includes(value)
    },
    color: {
      type: String,
      default: 'primary',
      validator: value => colours.includes(value)
    }
  },
  computed: {
    themeClass () {
      return `anchor anchor-${this.theme} color-${this.color}`
    }
  }
}
</script>

<style lang="scss">
.anchor{
  display: inline-block;
  cursor: pointer;
}
.anchor-cta{
  width: 230px;
  height: 56px;
  padding: 8px 28px 11.5px 42px;
  border-radius: 28px;
  color: #ffffff;
  font-size: 18px;
  font-weight: 500;
  font-stretch: normal;
  font-style: normal;
  line-height: 2.03;
  letter-spacing: normal;
  text-align: center;
  color: #ffffff;
  &.color-cta{
    background-color: var(--primary-1);
  }
  &.color-primary{
    background-color: var(--outline);
  }
  &.color-secondary{
    background-color: var(--outline-2);
  }
}
.anchor-primary{
  min-width: 130px;
  height: 40px;
  padding: 10px 22px 11px 21px;
  border-radius: 20.8px;
  font-size: 14px;
  font-weight: bold;
  font-stretch: normal;
  font-style: normal;
  letter-spacing: normal;
  text-align: center;
  color: #ffffff;
  &.color-cta{
    background-color: var(--primary-1);
  }
  &.color-primary{
    background-color: var(--outline);
  }
  &.color-secondary{
    background-color: var(--outline-2);
  }
}
.anchor-secondary{
  min-width: 112px;
  height: 44px;
  padding: 6px 12px 8.8px 10px;
  border-radius: 22.4px;
  font-size: 14px;
  font-weight: bold;
  font-stretch: normal;
  font-style: normal;
  line-height: 2.71;
  letter-spacing: normal;
  text-align: center;
  background-color: white;
  &.color-cta{
    border: solid 1.6px var(--primary-1);
  }
  &.color-primary{
    border: solid 1.6px var(--outline);
  }
  &.color-secondary{
    border: solid 1.6px var(--outline-2);
  }
}
.anchor-none{
  color: var(--body-standard);
  font-size: 16px;
  font-weight: normal;
  font-stretch: normal;
  font-style: normal;
  line-height: normal;
}
.anchor-icon{
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background-color: var(--img-holder);
  color: var(--body-dark);
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 0.9;
  &:hover{
    opacity:1;
  }
}
</style>
