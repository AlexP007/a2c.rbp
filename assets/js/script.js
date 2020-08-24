// animated icon
$(document).ready(function(){
    const icon = $("a[href^='#'][data-type='rbp-animated-icon']");
    if (icon.length < 1) {
        return;
    }
    const scrollContainerSelector = icon.data('selector');
    const scrollToFade = icon.data('scroll');
    let usePosition = true;
    if (scrollContainerSelector.includes('body') || scrollContainerSelector.includes('html')) {
        usePosition = false;
    }
    const scrollContainer = $(scrollContainerSelector);
    // icon fade out on scrolling
    if (icon.length > 0 && scrollContainer.length > 0) {
        if (scrollToFade !== undefined) {
            scrollContainer.on('scroll', () => {
                if (scrollContainer.scrollTop() > scrollToFade) {
                    icon.fadeOut(200);
                } else {
                    icon.fadeIn(200);
                }
            });
        }
        // smooth transition
        icon.on("click", function(e) {
            e.preventDefault();
            let hash = this.hash;
            let top = usePosition ? $(hash).position().top : $(hash).offset().top;
            scrollContainer.stop().animate({
                scrollTop: top
            }, 777);
            return false;
        });
    }
});
// accordion
$(document).ready(function() {
    $('[data-type=rbp-acc-opener]').on('click', accordion);

    function accordion(e) {
        e.preventDefault();
        const ref = e.target.closest('a');
        const up = ref.dataset.up;
        const down = ref.dataset.down;
        const target = $(ref.hash);
        const icon = $(ref).find('i');


        const accClose = (e) => {
            if (target.find(e.target).length > 0) {
                return;
            }
            target.slideUp(400);
            icon.get(0).className = down;
            $(document).off('click', accClose);
            $(ref).on('click', accordion);
        };

        target.slideDown(400);
        icon.get(0).className = up;
        $(document).on('click', accClose);
        e.stopPropagation();

        $(ref).off('click', accordion);
    }
});
