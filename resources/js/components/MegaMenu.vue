<template>
    <div>
        <button @click="toggleMenu" class="px-4 py-2 bg-blue-500 text-white">
            Mega Menu
        </button>

        <div v-if="showMenu" class="w-64 bg-white border border-gray-300">
            <div class="grid grid-cols-2 gap-4 p-4">
                <!-- Column 1 -->
                <div>
                    <h3 class="text-lg font-bold mb-2">Category 1</h3>
                    <ul>
                        <li v-for="item in category1" :key="item">
                            <a href="#" class="text-sm text-gray-700 hover:text-gray-900">{{ item }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Column 2 -->
                <div>
                    <h3 class="text-lg font-bold mb-2">Category 2</h3>
                    <ul>
                        <li v-for="item in category2" :key="item">
                            <a href="#" class="text-sm text-gray-700 hover:text-gray-900">{{ item }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showMenu: false,
            category1: ["Item 1", "Item 2", "Item 3"],
            category2: ["Item A", "Item B", "Item C"]
        };
    },
    methods: {
        toggleMenu() {
            this.showMenu = !this.showMenu;
        }
    }
};
</script>

<style scoped>
/* Add any additional styling here */
</style>
