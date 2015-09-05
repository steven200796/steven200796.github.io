            $("#images > div:gt(0)").hide();
            $("#verbs > span").hide();
            cycleWords();

            /* Init values 6000 and 1000 */
            var cycleTime = 6000;
            var fadeTime = 1000;

            function cycleWords() {
                $('#verbs > span:first')
                    .delay(500)
                    .fadeIn(fadeTime)
                    .delay(3500)
                    .fadeOut(fadeTime)
                    .next()
                    .end()
                    .appendTo('#verbs');
            }

            function cycleBackgrounds() {
                $('#images > div:first')
                    .fadeOut(fadeTime)
                    .next()
                    .fadeIn(fadeTime)
                    .end()
                    .appendTo('#images');
            }

            setInterval(cycleBackgrounds, cycleTime);
            setInterval(cycleWords, cycleTime);