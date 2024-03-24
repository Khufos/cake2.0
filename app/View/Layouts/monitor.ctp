<!DOCTYPE html>
<html>
    <head>
        <?php
        echo $this->Html->css('/fila/css/monitor');

        #slider includes
        echo $this->Html->css('/fila/css/anythingslider');
        echo $this->Html->script('/fila/js/jquery-git.js');
        echo $this->Html->script('/fila/js/jquery.anythingslider.js');
        echo $this->Html->script('/fila/js/jquery.anythingslider.video.js');
        echo $this->Html->css('/fila/css/generic');
        echo $this->Html->script('jquery/jquery-ui');
        ?>
        <style type="text/css">
            .style1 {
                color: #000000;
                font-weight: bold;
                margin-right:40px;
            }
            .style2 {
                font-weight: bold;
                margin-right:115px;
            }
            .style6 {color:#003366}
            .style5 {color:#000000}

            /*** Set Slider dimensions here! Version 1.7+ ***/

            /* New in version 1.7+ */
            ul#slider {
                width: 100%;
                height: 100%;
                list-style: none;
            }
            /* images with caption */
            ul#slider img {
                width: 100%;
                height: 100%;
            }
            /* position the panels so the captions appear correctly */
            ul#slider .panel { position: relative; }
            /* captions */
            ul#slider .caption-top, #slider .caption-right,
            ul#slider .caption-bottom, #slider .caption-left {
                background: #000;
                color: #fff;
                padding: 10px;
                margin: 0;
                position: relative;
                z-index: 10;
                opacity: .8;
                filter: alpha(opacity=80);
            }
            ul#slider li {
                position: relative;
            }

            .caption {
                width: 100%;
                height: 90px;
                margin: 0 auto;
                padding: 10px 0;
                border-top: #6EA829 5px solid; /* adjust border color and size here */
                text-align: center;
                font-size: 32px;
                background: rgba(30,30,30,.7); /* adjust caption background color here */
                color: #ddd;
                position: absolute;
                bottom: 0;
                left: 0;
                cursor: pointer;
            }
        </style>
        <script type="text/javascript">
            function chamar() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo Router::url('/', true); ?>" + "fila/fila_paineis/exibir?trs=1",
                    success: function(data) {
                        $("#alerta").empty().append(data);
                        $('#alerta').toggle('3000','pulsate');
                    },
                    complete: function() {
                        setTimeout(function() {
                            chamar();
                        }, 5000);
                    }
                });
            }
            chamar();
            //------------------Funções do Plugin
            $(function() {
                var playvid = function(slider) {
                    var vid = slider.$currentPage.find('video');
                    if (vid.length) {
                        // autoplay
                        vid[0].play();
                    }
                };

                // caption toggle animation time
                var toggleTime = 500,
                        // always show caption when slide comes into view
                        showCaptionInitially = true,
                        updateCaption = function(slider, init) {
                    if (init && showCaptionInitially) {
                        setTimeout(function() {
                            slider.$targetPage.find('.caption').animate({
                                bottom: 0
                            }, toggleTime);
                        }, slider.options.delayBeforeAnimate + toggleTime);
                    } else if (!init) {
                        var cap = slider.$lastPage.find('.caption');
                        cap.css('bottom', -cap.innerHeight());
                    }
                };

                $('#slider').anythingSlider({
                    autoPlay: true,
                    stopAtEnd: false,
                    infiniteSlides: true,
                    delay: 8000,
                    enableArrows: false,
                    // Autoplay video in initial panel, if one exists
                    onInitialized: function(e, slider) {
                        playvid(slider);
                        slider.$items.each(function() {
                            var cap = $(this).find('.caption');
                            cap.css('bottom', -cap.innerHeight()).click(function() {
                                cap.animate({
                                    bottom: (cap.css('bottom') === "0px" ? -cap.innerHeight() : 0)
                                }, toggleTime);
                            });
                            updateCaption(slider, true);
                        });
                    },
                    // Callback before slide animates
                    onSlideBegin: function(e, slider) {
                        updateCaption(slider, true);
                    },
                    // Callback after slide animates
                    onSlideComplete: function(slider) {
                        updateCaption(slider, false);
                    },
                    // pause video when out of view
                    onSlideInit: function(e, slider) {
                        var vid = slider.$lastPage.find('video');
                        if (vid.length && typeof(vid[0].pause) !== 'undefined') {
                            vid[0].pause();
                        }
                    },
                    onSlideComplete: function(slider) {
                        playvid(slider);
                    },
                    // pause slideshow if video is playing
                    isVideoPlaying: function(slider) {
                        var vid = slider.$currentPage.find('video');
                        return (vid.length && typeof(vid[0].pause) !== 'undefined' && !vid[0].paused && !vid[0].ended);
                    }
                });
            });//]]>         
        </script>
    </head>
    <body>
        <?php
        echo $this->fetch('content');
        ?>        
    </body>
</html>