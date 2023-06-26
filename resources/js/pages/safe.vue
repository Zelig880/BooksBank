<template>
  <div class="safe container mx-auto">
    <h2 class="text-3xl font-bold mb-6">Be Safe Online</h2>
    <p>Even if Booksbank is built and driven by a fantastic community of self-motivated and supportive members, it is essential to remember that the internet is not always secure place. As such, it is necessary to be safe.</p>
    <p>This page will share some tips to help you be safe when exchanging books on the platform.</p>
    <h3>Stay safe checklist</h3>
    <ul class="list-disc pl-5">
      <li>If possible, do not share your home address, but use a public place as your "preferred meeting point."</li>
      <li>Always try to be in the company of others when meeting new people</li>
      <li>Never allow anyone in your home</li>
      <li>Never disclose information about your property</li>
    </ul>
    <p>The list above is not exhaustive, and you should always seek information beforehand and take necessary precautions when meeting someone off an internet platform.</p>
    <p>Our mission is to allow everyone to enjoy a good read, which must be done most securely. Safety first!</p>
  </div>
</template>

<script>
export default {
  metaInfo () {
    return { title: this.$t('safeguarding') }
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
