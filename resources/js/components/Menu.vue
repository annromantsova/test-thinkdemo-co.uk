<template>
    <ul class="hidden lg:flex space-x-4">
        <li v-for="item in menuItems" :key="item.title">
            <a :href="item.link" @mouseover="showMenu(item)" @mouseout="hideMenu" class="hover:bg-gray-600 px-3 py-2 rounded-md text-sm font-medium">
                {{ item.title }}
            </a>
        </li>
    </ul>
</template>

<script>
export default {
    props: {
        menuItems: {
            type: Object,
            required: true,
            default: function() {
                return {
                    title: 'Default Title',
                    link: '#',
                    submenu: []
                };
            }
        },
        isActive: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        showMenu(item) {
            this.$emit('mouseover', item);
        },
        hideMenu() {
            this.$emit('mouseout');
        }
    }
}
</script>
