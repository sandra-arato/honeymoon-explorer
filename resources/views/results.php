<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <link rel="icon" href="static/favicon.ico" type="image/x-icon">
        <title>Eredmények</title>

        <!-- CSS -->
        <link rel="stylesheet" href="static/bootstrap.min.css">

        <style>
            @font-face {
              font-family: Custom;
              src: url('static/metafors-Regular.otf');
            }

            @font-face {
              font-family: Title;
              src: url('static/Besom-free-font.otf');
            }
            body{
              font-family: Custom;
              font-size: 22px;
              padding-top: 3.4rem;
              padding-bottom: 7.2rem;
            }
            h1 {
              font-family: Title;
              font-size: 7.4rem;
              text-align: center;
            }
            .africa     { background-color: #9fb56e; }
            .usa        { background-color: #f7c55d; }
            .europe     { background-color: #88c9b3; }
            .australia  { background-color: #ffb2a8; }
            .asia       { background-color: #82c2c6; }
            .central    { background-color: #bb9ee9; }
            ul {
              list-style: none;
              padding: 0;
            }

            li {
              font-size: 3rem;
              margin: 1.4rem 0;
              padding: 0.4rem 0;
              min-width: 100px;
              position: relative;
            }

            li span {
              box-sizing: border-box;
              display: inline-block;
              padding-left: 0.8rem;
              position: absolute;
              left: 9.4rem;
            }

            .table-responsive.hidden {
              display: none;
            }

            button {
              display: block;
              position: fixed;
              top: 1.3rem;
              right: 1.2rem;
            }
            footer {
              position: fixed;
              bottom: 3.4rem;
              width: 100%;
              text-align: center;
            }
            a {
              padding: 0.6rem 0.8rem;
              background: #88c9b3;
              border-radius: 2px;
              margin: 0 auto;
              width: auto;
              text-decoration: none;
              color: #fff;
            }
            a:hover, a:focus, a:active {
              text-decoration: none;
              color: #fff;
              background: #6d9a8b;
            }
        </style>

        <!-- JS -->
        <script src="static/jquery.min.js"></script>
        <script src="static/vue.min.js"></script>

    </head>

    <body class="container" id="guestbook">
        <div class="col-md-8 col-md-offset-2">
            <div>
              <h1>Irány {{ calculated.translator[calculated.top] }}!</h1>
              <ul id="repeat-object" class="demo">
                <li v-repeat="dest: calculated.destinations">
                  {{ calculated.translator[dest[0]] }}
                  <span class="{{ dest[0] }}"  style="width: {{ dest[1] }}%"> {{ dest[1] }}%</span>
                </li>
              </ul>
            </div>
            <button class="btn btn-default" type="button" id="votes">Szavazatok</button>
            <div class="table-responsive hidden">
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Ország</th>
                    <th>Mozi</th>
                    <th>Program</th>
                    <th>Cucc</th>
                    <th>Időtartam</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-repeat="entry: results">
                    <th>{{ entry.id }}</th>
                    <th>{{ entry.destination }}</th>
                    <th>{{ entry.movie }}</th>
                    <th>{{ entry.todo }}</th>
                    <th>{{ entry.item }}</th>
                    <th>{{ entry.duration }}</th>
                  </tr>
                </tbody>
              </table>
            </div>

        </div>
        <footer>
          <a href="/">Játssz még egyet!</a>
        </footer>
        <script type="text/javascript">
            new Vue({
                el: '#guestbook',

                data: {
                    comments: [],
                    text: '',
                    author: ''
                },

                ready: function() {
                    this.getMessages();
                },

                methods: {
                    getMessages: function() {
                        $.ajax({
                            context: this,
                            url: "/api/entry",
                            success: function (result) {
                                this.$set("results", result);
                                let calc = this.calculatePercentage(result);
                                console.log(calc.destinations[0]);
                                this.$set("calculated", calc);
                            }
                        })
                    },

                    calculatePercentage: function(data) {
                      let max = 0;
                      let sum = data.length;
                      let selected = '';
                      let destination = {
                        europe: 0,
                        usa: 0,
                        asia: 0,
                        australia: 0,
                        africa: 0,
                        central: 0
                      };

                      const translator = {
                        'africa': 'Afrika',
                        'europe': 'Európa',
                        'usa': 'USA',
                        'australia': 'Ausztrália',
                        'asia': 'Ázsia',
                        'central': 'A Karib'
                      }

                      data.forEach(function(i) {
                        if (typeof destination[i.destination] !== 'undefined') {
                          destination[i.destination]++;
                        }
                      });

                      for (dest in destination) {
                        if (destination[dest] > max) {
                          max = destination[dest];
                          selected = dest;
                        }
                      }
                      let sortable = [];
                      for (let i in destination) {
                        if (destination[i] > 0) {
                          sortable.push([i, Math.floor(100 * destination[i]/sum)]);
                        } else {
                          sortable.push([i, 0, 10]);
                        }

                        sortable.sort(
                          function(a, b) {
                            return b[1] - a[1]
                          }
                        );
                      }

                      return {
                        destinations: sortable,
                        top: selected,
                        sum: sum,
                        translator: translator
                      }
                    }
                }
            })
            var button = document.getElementById('votes');
            button.addEventListener('click', function(e) {
              e.target.nextElementSibling.classList.toggle('hidden');
              if (e.target.innerHTML === 'Szavazatok') {
                e.target.innerHTML = 'Elrejtés'
              } else {
                e.target.innerHTML = 'Szavazatok'
              }
            })
        </script>
    </body>
</html>
