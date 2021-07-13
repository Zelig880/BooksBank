<template>
  <div class="safe container mx-auto">
    <h2 class="text-3xl font-bold mb-6">Be safe online</h2>
    <p>Even if booksbank is built and driven by an amazing community of self motivated and supportive member. It is important to remember that the internet may not always be a safe place, and as such, it is important to try and be safe</p>
    <p>In this page we are going to share a couple of tips and tricks that can help you being safe when exchanging books on the platform.</p>
    <h3>Stay safe checklist</h3>
    <ul class="list-disc pl-5">
      <li>If possible, do not share your home address, but use a public place as your "preferred meeting point"</li>
      <li>Always try to be in company, when meeting other people</li>
      <li>Never allow anyone in your home</li>
      <li>Never disclose information about your property</li>
    </ul>
    <p>The list above is above is not at all concusive, and you should always seek information and do your best to be safe when surfing the internet, or meeting people from internet platform</p>
    <p>Our mission is to give the change for everyone to enjoy a good read, and it is essential that this is done in the most secure way.</p>
  </div>
</template>

<script>
export default {
  metaInfo () {
    return { title: this.$t('terms') }
  }
}
</script>

<style lang="scss">
.safe {
  h3 {
    @apply text-2xl font-semibold mb-6;
  }
  p,
  ul {
    margin-bottom: 12px;
  }
}
</style>
