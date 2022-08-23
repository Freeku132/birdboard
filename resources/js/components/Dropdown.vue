<template>
    <div class="dropdown">
<!--        trigger-->
        <div @click="isOpen = !isOpen">
        <slot name="trigger"></slot>
        </div>
        <!--        menu links-->
        <div v-show="isOpen"
             class="dropdown-menu">
            <slot></slot>
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return { isOpen: false }
        }
    }
</script>
