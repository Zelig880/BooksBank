<template>
  <div id="about" class="container mx-auto">
    <h2 class="text-3xl font-bold mb-6">About BooksBank</h2>

    <p>Booksbank is a community driven project, aimed at allowing everyone to be able to enjoy a nice read, by borrowing books that would otherwise sit on a shelf collecting dust.</p>

    <p>The heart of booksbank it's YOU! This project could not be possible, if it wasn't for the thousands of community memebers that are happy to lent their books.</p>

    <h3>The Story</h3>
    <p>BooksBank is the result of a need that raised during the pandemic that took place in 2020. The main idea was pretty simple. Create a platform that would allow local communities to share books between each other without the need to spend money or lose time having to ship/deliver them.</p>

    <h3>The development</h3>
    <p>The idea was pretty simple, the website development a bit less :)</p>
    <p>Following the first idea Simone (<a class="font-semibold underline" href="www.zelig880.com" target="_blank">Zelig880</a>) started a simple market research between friends and family to get ideas on how to be develop this application</p>
    <p>Following the initial idea, Simone has found some fantastic contributors that have given their time and energy in developing the application that you are using today</p>
    <h4>Special Thanks</h4>
    <ul class="list-disc pl-4">
      <li>My Wife for suffering my endless chat about the project</li>
      <li>Tircoed forest village community and Friends for helping me with the market research</li>
      <li>Robin Powell for the fantastic designs provided</li>
      <li>John for the amazing development contributions</li>
      <li>All the other fantastic <a class="font-semibold underline" href="https://github.com/Zelig880/BooksBank/graphs/contributors" target="_blank">contributors</a> (at time of writing this page: abhishek-bodapati, sosualfred, priyalnym123, Ojsholly, venkivijay, markshenouda, marcusmyers)</li>
      <li>YOU.. Without your books this project would not exist</li>
    </ul>
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
#about {
  h3 {
    @apply text-2xl font-semibold mb-6;
  }
  h4{
    @apply text-xl font-semibold mb-5;
  }
  p,
  ul {
    margin-bottom: 12px;
  }
}
</style>
