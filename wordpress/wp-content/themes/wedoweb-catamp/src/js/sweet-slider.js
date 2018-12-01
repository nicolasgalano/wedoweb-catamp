/**
 * Created by Juan on 6/2/2018.
 */
(function($) {
    $.fn.sweetSlider = function(options) {
        console.log('sweetSlider starting');
        var self = this;

        try {
            if(typeof jQuery == 'undefined') {
                throw('Jquery is a required dependency for the sweet-slider plugin');
            }
        }
        catch(e) {
            console.log(e);
            return;
        }

        self = {
            slides: self.find('.slide'),
            currentSlide: 0,
            current_frame: 0,
            total_frames: 60,
            paths: [],
            pathsLength: [],
            animationId: 0,
        };

        var start = () => {
            var currentSlide = $(self.slides[self.currentSlide]);
            currentSlide.fadeIn();
            prepareCurrentSvg(currentSlide);
            var svg = currentSlide.find('svg');
            svg.removeClass('hide');

            draw();
        }

        var prepareCurrentSvg = (currentSlide) => {
            currentSlide.find('svg path').each((i, el) => {
                self.paths.push(el);
                var l = self.paths[i].getTotalLength();
                self.pathsLength[i] = l;
                self.paths[i].style.strokeDasharray = l + ' ' + l;
                self.paths[i].style.strokeDashoffset = l;
            });
        }

        var draw = () => {
            var progress = self.current_frame/self.total_frames;
            if (progress > 1) {
                cancelAnimationFrame(this.animationId);
            } else {
                self.current_frame++;
                for(var j=0, len = self.paths.length; j<len;j++){
                    self.paths[j].style.strokeDashoffset = Math.floor(self.pathsLength[j] * (1 - progress));
                }
                this.animationId = requestAnimationFrame(function() { draw(); });
            }
        }
        start();
        // console.log(self.slides.length);
        // return self;
    }
}(jQuery));