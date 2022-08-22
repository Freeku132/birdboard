<template>
    <div class="mr-6">
        <button v-for="(color, theme) in themes"
                class="rounded-full w-5 h-5 bg-default border-2  mr-2"
                :class= "{ 'border-info': selectedTheme == theme}"
                :style="{backgroundColor: color}"

                @click="selectedTheme = theme"></button>


<!--        <button class="rounded-full w-5 h-5 bg-black border-2 mr-2"-->
<!--                :class= "{ 'border-info': selectedTheme == 'theme-dark'}"-->
<!--                @click="selectedTheme = 'theme-dark'"></button>-->

    </div>
</template>
<script>
    export default {
        data() {
            return {
                themes:
                    {
                        'theme-light': 'white',
                        'theme-dark': 'black',
                    },
                selectedTheme: 'theme-light'
            };
        },
        created() {
            this.selectedTheme = localStorage.getItem('theme') || "theme-light";
        },

        watch:{
            selectedTheme(){
                document.body.className = document.body.className.replace(/theme-\w+/, this.selectedTheme);

                localStorage.setItem('theme', this.selectedTheme);
            }
        }
    }
</script>
