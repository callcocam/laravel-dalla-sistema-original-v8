<template>
    <div id="sticky-header">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        data() {
            return {}
        },
        mounted(){
            let stickyHeader = document.getElementById('sticky-header');

            // then record the current position, so when we cross the
            // boundary the `sticky` class can be toggled
            let boundary = stickyHeader.scrollHeight;

            // when the page scrolls, do as little as possible, in this
            // case we're just registering a rAF callback to `checkSticky`
            window.onscroll = function (event) {

                requestAnimationFrame(()=>{
                    // collect current scroll position, with a arbitrary amount
                    // of inertia.
                    let y = window.innerHeight;

                    // check if the element contains the `sticky` class already
                    let isSticky = document.body.classList.contains('sticky');

                    if (y > boundary) {
                        // if we're in the "sticky" boundary, and it's not already
                        // sticky, then apply the class, otherwise do nothing.
                        if (!isSticky) {
                            document.body.classList.add('sticky');
                        }
                    } else if (isSticky) {
                        // otherwise, we're inside the region *and* the sticky
                        // class needs to be removed.
                        document.body.classList.remove('sticky');
                    }
                });
            };
        }
    }
</script>
<style scoped>
    #sticky-header {
        bottom: 20px;
    }

    body.sticky {
        padding-bottom: 100px;
    }

    .sticky #sticky-header {
        position: fixed;
        z-index: 1001;
        width: 66%;
    }
</style>
