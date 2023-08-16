<script>

import galleria from 'primevue/galleria';
import { defineComponent, ref } from 'vue';

export default defineComponent({
    components: {
        galleria,
    },

    setup() {
        const images = ref([
            {
                itemImageSrc: 'images/foto12.jpg',
                thumbnailImageSrc: 'images/foto12.jpg',
            },
            {
                itemImageSrc: 'images/fondoupq5.jpg',
                thumbnailImageSrc: 'images/fondoupq5.jpg',
            },
            {
                itemImageSrc: 'images/foto22.jpg',
                thumbnailImageSrc: 'images/foto22.jpg', 
            },
            {
                itemImageSrc: 'images/foto32.jpg',
                thumbnailImageSrc: 'images/foto32.jpg',
            },
        ]);
        return {
            images,
        };
    },

    data() {
        return {
            activeIndex: 0,
            showThumbnails: false,
            fullScreen: false,
            galleriaClass: 'custom-galleria',
        };
    },

   
    methods: {
        onThumbnailButtonClick() {
            this.showThumbnails = !this.showThumbnails;
        },
        toggleFullScreen() {
            if (this.fullScreen) {
                this.closeFullScreen();
            }
            else {
                this.openFullScreen();
            }
        },
        onFullScreenChange() {
            this.fullScreen = !this.fullScreen;
        },
        openFullScreen() {
            let elem = this.$refs.galleria.$el;
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            }
            else if (elem.mozRequestFullScreen) { /* Firefox */
                elem.mozRequestFullScreen();
            }
            else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
                elem.webkitRequestFullscreen();
            }
            else if (elem.msRequestFullscreen) { /* IE/Edge */
                elem.msRequestFullscreen();
            }
        },
        closeFullScreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
            else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            }
            else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
            else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        },
        bindDocumentListeners() {
            document.addEventListener("fullscreenchange", this.onFullScreenChange);
            document.addEventListener("mozfullscreenchange", this.onFullScreenChange);
            document.addEventListener("webkitfullscreenchange", this.onFullScreenChange);
            document.addEventListener("msfullscreenchange", this.onFullScreenChange);
        },
        unbindDocumentListeners() {
            document.removeEventListener("fullscreenchange", this.onFullScreenChange);
            document.removeEventListener("mozfullscreenchange", this.onFullScreenChange);
            document.removeEventListener("webkitfullscreenchange", this.onFullScreenChange);
            document.removeEventListener("msfullscreenchange", this.onFullScreenChange);
        }
    },
    computed: {
        // galleriaClass() {
        //     return ['custom-galleria', {'fullscreen': this.fullScreen}]; 
        // },
        fullScreenIcon() {
            return `pi ${this.fullScreen ? 'pi-window-minimize' : 'pi-window-maximize'}`;
        }
    }
});

</script>

<template>

<galleria ref="galleria" :value="images" v-model:activeIndex="activeIndex" :numVisible="5" containerStyle="min-height: fullscreen" :containerClass="galleriaClass"
    :showThumbnails="showThumbnails" :showItemNavigators="true" :showItemNavigatorsOnHover="true"
    :circular="true" :autoPlay="true" :transitionInterval="3000">
    <template #item="slotProps">
        <img :src="slotProps.item.itemImageSrc" :alt="slotProps.item.alt" :style="[{'width': !fullScreen ? '100%' : '','height': !fullScreen ? '100vh' : '', 'display': !fullScreen ? 'block' : ''}]" />
    </template>
    <template #thumbnail="slotProps">
        <div class="grid grid-nogutter justify-content-center">
            <img :src="slotProps.item.thumbnailImageSrc" :alt="slotProps.item.alt" style="display: block;" />
        </div>
    </template>
</galleria>

</template>


<style type="text/css" scoped>
    ::v-deep(.custom-galleria).fullscreen {
        display: flex;
        flex-direction: column;
        height: 100vh;
        width: 100%;
        align-items: center;
        justify-content: center;
    }
    ::v-deep(.custom-galleria).fullscreen .p-galleria-content {
        flex-grow: 1;
        justify-content: center;
        height: 100vh;
        width: 100%;
    }
    ::v-deep(.custom-galleria) .p-galleria-content {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
    }
    ::v-deep(.custom-galleria) .p-galleria-thumbnail-wrapper {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100vh;
    }
    ::v-deep(.custom-galleria) .p-galleria-thumbnail-items-container {
        width: 100%;
        height: 100vh;
    }
    ::v-deep(.custom-galleria) .custom-galleria-footer {
        display: flex;
        align-items: center;
        background-color: rgba(0, 0, 0, .9);
        color: #fff;
        width: 100%;
        height: 100vh;
    }
    ::v-deep(.custom-galleria) .custom-galleria-footer > button {
        background-color: transparent;
        color: #fff;
        border: 0 none;
        border-radius: 0;
        margin: 0.2rem 0;
    }
    ::v-deep(.custom-galleria) .custom-galleria-footer > button.fullscreen-button {
        margin-left: auto;
    }
    ::v-deep(.custom-galleria) .custom-galleria-footer > button:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    ::v-deep(.custom-galleria) .title-container > span {
        font-size: 0.9rem;
        padding-left: 0.829rem;
    }
    ::v-deep(.custom-galleria) .title-container > span.title {
        font-weight: bold;
    }
</style>


