<template>
  <span :class="{mobile: mobile, authControl: true}">
    <!-- Authenticated -->
    <template v-if="authenticated">
      <Anchor :theme="buttonTheme" route-name="welcome" class="mr-3">
        <fa icon="search" aria-label="Search" />
        <template v-if="mobile">
          Search
        </template>
      </Anchor>
      <Anchor :theme="buttonTheme" route-name="bookshelf.all" class="mr-3">
        <fa icon="book" aria-label="Dashboard" />
        <template v-if="mobile">
          Dashboard
        </template>
      </Anchor>
      <Anchor :theme="buttonTheme" route-name="bookshelf.info" class="mr-3">
        <fa icon="bell" aria-label="Notification" />
        <template v-if="mobile">
          Notification
        </template>
      </Anchor>
      <Anchor :theme="buttonTheme" route-name="bookshelf.settings" class="mr-3">
        <fa icon="cog" aria-label="Settings" />
        <template v-if="mobile">
          Settings
        </template>
      </Anchor>
      <Button :theme="buttonTheme" class="mr-3" @click="$emit('logout')">
        <fa icon="sign-out-alt" aria-label="Settings" />
        <template v-if="mobile">
          Log out
        </template>
      </Button>
    </template>
    <!-- Non Authenticated -->
    <template v-else>
      <Anchor theme="none" route-name="login" class="pt-2 mr-6">
        {{ $t('login') }}
      </Anchor>
      <Anchor theme="none" route-name="register" class="pt-2 mr-5">
        {{ $t('register') }}
      </Anchor>
    </template>
    <Anchor theme="primary" color="primary" route-name="bookshelf.add">
      Add a book
    </Anchor>
  </span>
</template>

<script>
export default {
  props: {
    authenticated: {
      type: Boolean,
      required: true
    },
    mobile: {
      type: Boolean,
      required: true
    }
  },
  computed: {
    buttonTheme () {
      return this.mobile ? 'none' : 'icon'
    }
  }
}
</script>

<style lang="scss">
.authControl{
  &.mobile{
    display: flex;
    flex-direction: column;
    & > * {
      height:40px;
      width: 100%;
      text-align: center;
    }
  }
}

</style>
