<script>
export default {
    props: ['audio', 'playControl'],
    mounted () {
        // this.initPlayer()
        // this.getPlayerCurrentTime()
    },
    methods: {
        initPlayer () {
            // this.player = new Audio('/mp3/outfoxing.mp3')
            this.player = new Audio(this.audio)
            this.player.addEventListener('error', () => {
                console.error(`Error playing: ${this.audio}`)
            })

            // this.player.addEventListener('timeupdate', () => {
            //     console.info(this.player.currentTime)
            //     this.currentTime = this.player.currentTime
            // })
        },
        getPlayerCurrentTime () {
            this.player.ondurationchange = () => {}
        },
        getCurrentText () {
            if (this.currentSub.text) {
                return this.currentSub.text
            }
            return 'initilizing'
        },
        updateCurrentSub () {
            if (!this.currentSub && this.subCounter == 0) {
                this.currentSub = this.subtitle[this.subCounter]
                this.currentTime = this.player.currentTime
                this.endTime = this.currentSub.endTime
            } else if (this.subCounter < this.totalSubs) {
                this.subCounter++
                this.currentSub = this.subtitle[this.subCounter]
                this.currentTime = this.player.currentTime
                this.endTime = this.currentSub.endTime
            }
        },
        subtitlePlay () {},
        togglePlay () {
            if (!this.audio) {
                return
            }
            if (this.player.paused) {
                this.player.play()
            } else {
                this.player.pause()
            }
        }
    },
    watch: {
        currentTime (n, o) {
            if (
                this.currentTime == this.endTime ||
                this.currentTime > this.endTime
            ) {
                this.updateCurrentSub()
            }
        },
        playControl: function (n, o) {
            //   this.initPlayer()
            this.togglePlay()
        },
        audio: function (n, o) {
            this.initPlayer()
            //  this.player.play()
        }
    },
    data () {
        return {
            subCounter: null,
            totalSubs: null,
            currentSub: '',
            currentTime: null,
            endTime: null,
            duration: null,
            player: null,
            subtitle: []
        }
    }
}
</script>

<template>
    <div>
        <!-- <audio id="sub_audio">
            <source :src="audio" type="audio/mpeg" />
            Your browser does not support the audio tag.
        </audio> -->
        <!-- subtitle wrapper start  -->
    </div>
</template>
