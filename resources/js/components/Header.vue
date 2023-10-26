<template>
    <nav class="header-nav bg-white border-gray-200 dark:border-gray-600 dark:bg-gray-900">
        <div class="container flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <a href="#" class="flex items-center">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Logo</span>
            </a>
        </div>
    </nav>
    <nav class="header-nav bg-nav border-gray-200 dark:border-gray-600 ">
        <div class="container flex flex-wrap justify-between items-center mx-auto max-w-screen-xl ">
            <button data-collapse-toggle="mega-menu-full-image" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="mega-menu-full-image" aria-expanded="false" @click="toggleMegaMenu">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <div id="mega-menu-full-image"
                 class=" header-nav__col items-center justify-between hidden w-full md:flex md:w-auto md:order-1 ">
                <ul class="header-nav__list">
                    <li class="group/dropdown py-2.5">
                        <button @mouseenter="toggleMegaMenu" @click="toggleMegaMenu" class="text-white font-primary flex items-center gap-1 px-3"
                                aria-controls="mega-menu-full-image-dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"
                                 class="fill-white">
                                <path
                                    d="M80 368H16a16 16 0 0 0-16 16v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16v-64a16 16 0 0 0-16-16zm0-320H16A16 16 0 0 0 0 64v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16V64a16 16 0 0 0-16-16zm0 160H16a16 16 0 0 0-16 16v64a16 16 0 0 0 16 16h64a16 16 0 0 0 16-16v-64a16 16 0 0 0-16-16zm416 176H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 160H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z"/>
                            </svg>
                            Products
                        </button>
                    </li>

                </ul>

            </div>
        </div>
        <div v-if="megaMenuVisible" id="mega-menu-full-image-dropdown" @mouseleave="hideMegaMenuDelayed"
             class="header-nav__menu-content falldown mt-1 bg-white border-gray-200 shadow-sm border-y dark:border-gray-600">
            <div
                class="grid md:max-w-screen-xl  sm:max-w-screen-sm px-4 py-5 mx-auto text-sm text-gray-500 dark:text-gray-400 md:grid-cols-3 md:px-0 sm:grid-cols-1">
                <ul class="shopNav  mb-4 mx-0 space-y-4 md:mb-0 md:block max-w-full justify-items-stretch">
                    <li v-for="category in productCategories" :key="category.name"
                        class="menu-item-has-children group/item "
                    >
                        <a href="#" @mouseenter="setCurrentCategory(category)"
                           class="text-default flex w-full items-center justify-between px-2 py-1.5 hover:text-white hover:bg-pink-600">
                            {{ category.name }}
                            <span v-if="category.products">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 192 512"
                                     class="fill-default group-hover/item:fill-white">
                                <path
                                    d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"/>
                            </svg>
                            </span>
                        </a>

                    </li>
                </ul>
                <ul class="mb-4 space-y-0 md:mb-0 max-w-[370px] justify-self-star transition-all duration-500 group-hover/item:left-[370px] group-hover/item:opacity-100 group-hover/item:z-10"
                    v-if="currentCategory">
                    <li v-for="product in currentCategory.products" :key="product.name">
                        <a :href="product.link"
                           class="text-default flex w-full items-center justify-between px-2 py-1.5 hover:text-white hover:bg-pink-600">{{
                                product.name
                            }}
                        </a>
                    </li>
                </ul>
                <a href="#"
                   class="p-8 min-h-[200px] text-left bg-local bg-gray-500 bg-center bg-no-repeat bg-cover rounded-lg px-4 py-2.5  max-w-[386px] bg-blend-multiply hover:bg-blend-soft-light dark:hover:bg-blend-darken"
                   style="background-image: url('')">

                </a>
            </div>
        </div>
    </nav>
</template>

<script>
import {ref ,onMounted} from 'vue';

export default {
    setup() {
        const megaMenuVisible = ref(true);
        const hideTimeout = ref(null);
        const currentCategory = ref(null);
        const productCategories = ref([
            {
                name: 'General Scaffold Products',
                products: [
                    {name: 'View all', link: '/#'},
                    {name: 'Scaffold Tube', link: '/#'},
                    {name: 'Scaffold Fittings', link: '/#'},
                    {name: 'Scaffold Boards', link: '/#'}
                ]
            },
            {
                name: 'Height Safety Equipment',
                products: [
                    {name: 'View all', link: '/#'},
                    {name: 'Safety Helmets', link: '/#'},
                    {name: 'Harnesses & Lanyards', link: '/#'},
                    {name: 'Fall Arrest Blocks', link: '/#'}
                ]
            },
            {
                name: 'Scaffold Tooling & Tethering',
                products: [
                    {name: 'View all', link: '/#'},
                    {name: 'Scaffold Belts & Frogs', link: '/#'},
                    {name: 'Scaffolding Spanners', link: '/#'},
                    {name: 'Scaffolding Hammers', link: '/#'},
                    {name: 'Spirit Levels', link: '/#'},
                    {name: 'Tool Lanyards & Tethers', link: '/#'}
                ]
            },
            {
                name: 'Scaffold Fixings',

            },
            {
                name: 'Scaffold Fixings',
                products: [
                    {name: 'View all', link: '/#'},
                    {name: 'Excalibur Screwbolts', link: '/#'},
                    {name: 'Ties, Rings & Hooks', link: '/#'},
                    {name: 'Key Clamps', link: '/#'}
                ]
            },
            {
                name: 'Sheeting, Debris Netting & Brickguards',
                products: [
                    {name: 'View all', link: '/#'},
                    {name: 'Standard Sheeting', link: '/#'},
                    {name: 'Fire Retardant Sheeting', link: '/#'},
                    {name: 'Brickguards', link: '/#'}
                ]
            },
            {
                name: 'Accessories',
                products: [
                    {name: 'View all', link: '/#'},
                    {name: 'Gin Wheels', link: '/#'},
                    {name: 'Safety Signage', link: '/#'},
                    {name: 'Ladder Access Gates', link: '/#'}
                ]
            }
        ]);
        onMounted(() => {
            currentCategory.value = productCategories.value[0];
        });


        const showMegaMenu = () => {
            if (hideTimeout.value) {
                clearTimeout(hideTimeout.value);
                hideTimeout.value = null;
            }
            megaMenuVisible.value = true;
        };

        const toggleMegaMenu = () => {
            if (hideTimeout.value) {
                clearTimeout(hideTimeout.value);
                hideTimeout.value = null;
            }
            megaMenuVisible.value = !megaMenuVisible.value;
            console.log(megaMenuVisible.value);
        };

        const hideMegaMenuDelayed = () => {
            if (hideTimeout.value) {
                clearTimeout(hideTimeout.value);
            }
            hideTimeout.value = setTimeout(() => {
                megaMenuVisible.value = false;
            }, 500);
        };

        const setCurrentCategory = (category) => {
            currentCategory.value = category;
        };

        return {
            megaMenuVisible,
            hideTimeout,
            currentCategory,
            productCategories,
            showMegaMenu,
            toggleMegaMenu,
            hideMegaMenuDelayed,
            setCurrentCategory
        };
    }

}
</script>

<!-- ... styles ... -->
