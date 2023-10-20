import NProgress from 'nprogress'

const progress = NProgress.configure({
    easing: 'ease',
    speed: 500,
    showSpinner: false,
    color: '#3498db',
    trailColor: '#E6E6E6',
    minimum: 0.4
})

export default progress
