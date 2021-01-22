<section class="map_section">
  <div class="container">
    <div class="row" id="apps" v-cloak>
      <div class="col-md-6" v-if="gca" style="min-height: 60vh">
        <span class="template_span">@{{ gca.title }}</span>
        <p style="line-height: 12px;">@{{ gca.bilateral }} Bilateral projects</p>
        <p style="line-height: 12px;">@{{ gca.transnational }} Transnational projects</p>
        <span class="template_span">Contacts</span>
        <p style="line-height: 12px;">
          <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M3.38433 4.61486C4.17608 5.40595 5.09337 6.16304 5.45599 5.8005C5.97465 5.28194 6.29475 4.82989 7.43911 5.74949C8.58298 6.6686 7.7042 7.28167 7.20154 7.78372C6.62136 8.36379 4.45867 7.81473 2.321 5.67798C0.183822 3.54074 -0.363852 1.37849 0.216832 0.798424C0.719491 0.295367 1.32968 -0.582733 2.24897 0.560897C3.16876 1.70453 2.71712 2.02456 2.19746 2.54362C1.83634 2.90617 2.59308 3.82327 3.38433 4.61486Z"
              fill="#2DA37D" />
          </svg>
          @{{ gca.phone }}
        </p>
        <p style="line-height: 12px;">
          <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M9 0H1C0.45 0 0.005 0.45 0.005 1L0 7C0 7.55 0.45 8 1 8H9C9.55 8 10 7.55 10 7V1C10 0.45 9.55 0 9 0ZM9 2L5 4.5L1 2V1L5 3.5L9 1V2Z"
              fill="#2DA37D" />
          </svg>
          @{{ gca.email }}
        </p>
        <p style="line-height: 12px;">
          <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M3.12695 0C1.39962 0 0 1.394 0 3.1207C0 6.10632 3.12695 10 3.12695 10C3.12695 10 6.25391 6.10569 6.25391 3.1207C6.25391 1.39462 4.85428 0 3.12695 0ZM3.12695 4.8474C2.67912 4.8474 2.24963 4.6695 1.93297 4.35284C1.6163 4.03617 1.4384 3.60668 1.4384 3.15885C1.4384 2.71102 1.6163 2.28153 1.93297 1.96486C2.24963 1.64819 2.67912 1.47029 3.12695 1.47029C3.57479 1.47029 4.00428 1.64819 4.32094 1.96486C4.63761 2.28153 4.81551 2.71102 4.81551 3.15885C4.81551 3.60668 4.63761 4.03617 4.32094 4.35284C4.00428 4.6695 3.57479 4.8474 3.12695 4.8474Z"
              fill="#2DA37D" />
          </svg>
          @{{ gca.address }}
        </p>
        <p style="line-height: 12px;">
          <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M3.12695 0C1.39962 0 0 1.394 0 3.1207C0 6.10632 3.12695 10 3.12695 10C3.12695 10 6.25391 6.10569 6.25391 3.1207C6.25391 1.39462 4.85428 0 3.12695 0ZM3.12695 4.8474C2.67912 4.8474 2.24963 4.6695 1.93297 4.35284C1.6163 4.03617 1.4384 3.60668 1.4384 3.15885C1.4384 2.71102 1.6163 2.28153 1.93297 1.96486C2.24963 1.64819 2.67912 1.47029 3.12695 1.47029C3.57479 1.47029 4.00428 1.64819 4.32094 1.96486C4.63761 2.28153 4.81551 2.71102 4.81551 3.15885C4.81551 3.60668 4.63761 4.03617 4.32094 4.35284C4.00428 4.6695 3.57479 4.8474 3.12695 4.8474Z"
              fill="#2DA37D" />
          </svg>
          @{{ gca.wep }}
        </p>
        <span v-if="news && news.length > 0" class="template_span">News and Events</span>
        <div style="padding: 15px 30px;margin-bottom:0;" class="new_event" v-for="item in news">
          <img :src="'/storage/posts/' + item.cover">
          <div class="new_event_date">
            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M5.5 11C4.4122 11 3.34884 10.6774 2.44437 10.0731C1.5399 9.46874 0.834947 8.60975 0.418665 7.60476C0.00238306 6.59977 -0.106535 5.4939 0.105683 4.42701C0.317902 3.36011 0.841726 2.3801 1.61091 1.61091C2.3801 0.841726 3.36011 0.317902 4.42701 0.105683C5.4939 -0.106535 6.59977 0.00238306 7.60476 0.418665C8.60975 0.834947 9.46874 1.5399 10.0731 2.44437C10.6774 3.34884 11 4.4122 11 5.5C11 6.95869 10.4205 8.35764 9.38909 9.38909C8.35764 10.4205 6.95869 11 5.5 11ZM5.5 0.785717C4.5676 0.785717 3.65615 1.0622 2.88089 1.58022C2.10563 2.09823 1.50138 2.8345 1.14457 3.69592C0.787757 4.55735 0.694399 5.50523 0.8763 6.41971C1.0582 7.33419 1.50719 8.1742 2.1665 8.8335C2.8258 9.49281 3.66581 9.9418 4.58029 10.1237C5.49477 10.3056 6.44266 10.2122 7.30408 9.85543C8.1655 9.49862 8.90177 8.89438 9.41979 8.11912C9.9378 7.34386 10.2143 6.4324 10.2143 5.5C10.2143 4.2497 9.7176 3.0506 8.8335 2.1665C7.9494 1.2824 6.75031 0.785717 5.5 0.785717Z"
                fill="#2DA37D" />
              <path d="M7.30322 7.85721L5.10715 5.66114V1.96436H5.89286V5.33507L7.85715 7.30328L7.30322 7.85721Z"
                fill="#2DA37D" />
            </svg>
            @{{ item.created_at }}
          </div>
          <div class="new_event_adr">
            <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M3.43965 0C1.53959 0 0 1.5334 0 3.43277C0 6.71695 3.43965 11 3.43965 11C3.43965 11 6.8793 6.71626 6.8793 3.43277C6.8793 1.53408 5.33971 0 3.43965 0ZM3.43965 5.33215C2.94703 5.33215 2.47459 5.13645 2.12626 4.78812C1.77793 4.43979 1.58224 3.96735 1.58224 3.47473C1.58224 2.98212 1.77793 2.50968 2.12626 2.16135C2.47459 1.81301 2.94703 1.61732 3.43965 1.61732C3.93227 1.61732 4.40471 1.81301 4.75304 2.16135C5.10137 2.50968 5.29706 2.98212 5.29706 3.47473C5.29706 3.96735 5.10137 4.43979 4.75304 4.78812C4.40471 5.13645 3.93227 5.33215 3.43965 5.33215Z"
                fill="#2DA37D" />
            </svg>
            News
          </div>
          <a :href="'/en/posts/1603259067/' + item.group">@{{ item.title }}</a>
        </div>
      </div>
      <div class="col-md-6">
        <div id="chartdiv" style="height: 100%"></div>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  let app = new Vue({
    el: "#apps",
    
    data: {
      gca: '',
      news: ''
    },

    methods: {
      init () {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create map instance
        var chart = am4core.create("chartdiv", am4maps.MapChart);
        chart.logo.disabled = true;

        // Set map definition
        chart.geodata = am4geodata_worldLow;

        // Set projection
        chart.projection = new am4maps.projections.Miller();

        // Series for World map
        var worldSeries = chart.series.push(new am4maps.MapPolygonSeries());
        worldSeries.include = ["UZ", "KZ", "TM", "AF", "KG", "TJ"];

        worldSeries.useGeodata = true;

        var polygonTemplate = worldSeries.mapPolygons.template;
        polygonTemplate.tooltipText = "{name}";
        polygonTemplate.fill = chart.colors.getIndex(0);
        polygonTemplate.nonScalingStroke = true;

        polygonTemplate.events.on("hit", function (ev) {
          if (ev.target.dataItem.dataContext.name == 'Turkmenistan')
            app.getGcaInfo('TM')
          else if (ev.target.dataItem.dataContext.name == 'Uzbekistan')
            app.getGcaInfo('UZ')
          else if (ev.target.dataItem.dataContext.name == 'Kazakhstan')
            app.getGcaInfo('KZ')
          else if (ev.target.dataItem.dataContext.name == 'Kyrgyzstan')
            app.getGcaInfo('KG')
          else if (ev.target.dataItem.dataContext.name == 'Afghanistan')
            app.getGcaInfo('AF')
          else if (ev.target.dataItem.dataContext.name == 'Tajikistan')
            app.getGcaInfo('TJ')
        });
        // Hover state
        var hs = polygonTemplate.states.create("hover");
        hs.properties.fill = am4core.color("#367B25");

        // Series for United States map
        var usaSeries = chart.series.push(new am4maps.MapPolygonSeries());
        // usaSeries.geodata = am4geodata_usaLow;

        var usPolygonTemplate = usaSeries.mapPolygons.template;
        usPolygonTemplate.tooltipText = "{name}";
        usPolygonTemplate.fill = chart.colors.getIndex(1);
        usPolygonTemplate.nonScalingStroke = true;

        // Hover state
        var hs = usPolygonTemplate.states.create("hover");
        hs.properties.fill = am4core.color("#367B25");
      },

      getGcaInfo (prefix) {
        axios
          .get("{{ route('gca.info.get', ['lang' => app()->getLocale()]) }}", {
            params: {
              prefix: prefix
            }
          })
          .then(function (response) {
            app.gca = response.data;
            app.news = response.data.news;
          })
          .catch(function (error) {
            console.log(error);
          })
          .then(function () {
            // always executed
          });
      }
    },

    mounted() {
      this.init();
      this.getGcaInfo("UZ");
    }
  })
</script>
@endpush