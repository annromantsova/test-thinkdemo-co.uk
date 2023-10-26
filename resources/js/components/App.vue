<template>
    <div class="min-h-screen flex flex-col">
        <Header />
        <BodyContent class="flex-grow" />
        <Footer />
    </div>
</template>

<script>
import Header from './Header.vue';
import Footer from './Footer.vue';
import BodyContent from './BodyContent.vue';


export default {
    components: {
        Header,
        Footer,
        BodyContent
    }
};
</script>
