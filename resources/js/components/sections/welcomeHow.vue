<template>
  <div class="welcomeHow bg-white relative flex flex-wrap items-center justify-between">
    <div class="container px-4 mx-auto my-12 flex items-center justify-between md:py-40">
      <div class=" inline-block md:w-4/6 lg:w-1/2 md:mr-16">
        <h3 class="Light-backgroundH1---h6H2">{{ $t('welcomeHow-title') }}</h3>
        <sub class="Light-backgroundH1---h6H4">{{ $t('welcomeHow-subtitle') }}</sub>
        <ol class="Light-backgroundBody-textStadard-body-18px">
          <li>{{ $t('welcomeHow-step1') }}</li>
          <li>{{ $t('welcomeHow-step2') }}</li>
          <li>{{ $t('welcomeHow-step3') }}</li>
          <li>{{ $t('welcomeHow-step4') }}</li>
        </ol>
      </div>
      <div class="hidden md:inline-block md:w-2/6 lg:w-1/2">
        <img class="welcomeHow_illustration" src="/assets/img/how-it-works.svg" alt="Illustration of lady reading a book">
      </div>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss">
.welcomeHow{
  ol{
    counter-reset: list-counter;
    margin-top:2.5rem;
  }
  li{
    counter-increment: list-counter;
    &:before{
      content: counter(list-counter)".";
      margin-right: 2rem;
      opacity: 0.75;
      font-size: 40px;
      font-weight: 300;
      color: var(--body-tertiaty);
    }
  }
}

@media (max-width: 768px) {
  .welcomeHow{
    li {
      margin-bottom: 20px;
      font-size: 16px;
      &:before {
        font-size: 25px;
        margin-right: 0.5rem;
      }
    }
  }
}
</style>
