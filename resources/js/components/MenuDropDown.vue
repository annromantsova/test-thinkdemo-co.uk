<template>
    <div class="absolute left-0 mt-2 w-full bg-white rounded-md shadow-lg">
        <ul>
            <li v-for="item in menuItems.submenu" :key="item.title">
                <a :href="item.link" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    {{ item.title }}
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        menuItems: {
            type: Object,
            required: true,
            default: function() {
                return {
                    title: 'test',
                    link: '#',
                    submenu: []
                };
            }
        }
    }
}
</script>
