<template>
    <vue-frappe
            id="test"
            :labels="[
                '12am-3am', '3am-6am', '6am-9am', '9am-12pm',
                '12pm-3pm', '3pm-6pm', '6pm-9pm', '9pm-12am'
            ]"
            title="My Awesome Chart"
            type="axis-mixed"
            :height="300"
            :colors="['purple', '#ffa3ef', 'light-blue']"
            :dataSets="this.data">
        </vue-frappe>
</template>
<script>
    export default {
        data () {
            return {
                data: [{
                    name: "Some Data", chartType: 'bar',
                    values: [25, 40, 30, 35, 8, 52, 17, -4]
                },
                {
                    name: "Another Set", chartType: 'bar',
                    values: [25, 50, -10, 15, 18, 32, 27, 14]
                },
                {
                    name: "Yet Another", chartType: 'line',
                    values: [15, 20, -3, -15, 58, 12, -17, 37]
                }]
            }
        }
    }
</script>