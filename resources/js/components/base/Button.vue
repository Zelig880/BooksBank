<template>
  <div :class="themeClass" role="button" @click="handleClick">
    <slot />
  </div>
</template>

<script>
const themes = ['cta', 'primary', 'secondary', 'square', 'icon']
const colours = ['primary', 'secondary', 'cta']

export default {
  name: 'Button',
  props: {
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
    },
    disabled: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  computed: {
    themeClass () {
      let classes = `button button-${this.theme} color-${this.color}`
      if (this.disabled) classes += ' button-disabled'

      return classes
    }
  },
  methods: {
    handleClick () {
      if (this.disabled) return
      this.$emit('click')
    }
  }
}
</script>

<style lang="scss">
.button{
  display: inline-block;
  cursor: pointer;
}
.button-cta{
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
.button-primary{
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
.button-secondary{
  min-width: 112px;
  height: 40px;
  padding: 6px 12px 8.8px 10px;
  border-radius: 22.4px;
  font-size: 14px;
  font-weight: bold;
  font-stretch: normal;
  font-style: normal;
  letter-spacing: normal;
  text-align: center;
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
.button-square{
  width: 278px;
  height: 56px;
  margin: 8px 17px 14px 0;
  padding: 9px 50px 10.5px 51px;
  border-radius: 5px;
  font-family: OpenSans;
  font-size: 18px;
  font-weight: 600;
  font-stretch: normal;
  font-style: normal;
  line-height: 2.03;
  letter-spacing: normal;
  text-align: center;
  color: var(--outline-2);
  border: solid 1.6px var(--outline-2);
  &:hover, &.color-primary{
    background-color: var(--outline-2);
    color: white;
  }
}
.button-icon{
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
.button-disabled{
  cursor:not-allowed;
  background-color: var(--secondary-4) !important;
}
</style>
