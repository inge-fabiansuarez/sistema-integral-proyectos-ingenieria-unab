  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
      <div class="container">
          <div class="row">
              {{-- <div class="col-lg-8 mb-4 mx-auto text-center">
          <a href="https://metrogasesp.com/web/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              Compañia
          </a>
          <a href="https://metrogasesp.com/web/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
              Nosotros
          </a>
      </div> --}}
              @if (!auth()->user() || \Request::is('static-sign-up'))
                  <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
                      <a target="_blank" class="text-secondary me-xl-4 me-4">
                          <span class="text-lg fab fa-dribbble" aria-hidden="true"></span>
                      </a>
                      <a target="_blank" class="text-secondary me-xl-4 me-4">
                          <span class="text-lg fab fa-twitter" aria-hidden="true"></span>
                      </a>
                      <a target="_blank" class="text-secondary me-xl-4 me-4">
                          <span class="text-lg fab fa-instagram" aria-hidden="true"></span>
                      </a>
                      <a target="_blank" class="text-secondary me-xl-4 me-4">
                          <span class="text-lg fab fa-pinterest" aria-hidden="true"></span>
                      </a>
                      <a target="_blank" class="text-secondary me-xl-4 me-4">
                          <span class="text-lg fab fa-github" aria-hidden="true"></span>
                      </a>
                  </div>
              @endif
          </div>
          @if (!auth()->user() || \Request::is('static-sign-up'))
              <div class="row">
                  <div class="col-8 mx-auto text-center mt-1">
                      <p class="mb-0 text-secondary">
                          <a style="color: #252f40;" class="font-weight-bold ml-1" target="_blank">
                              {{ env('FOOTER_MESSAGE') }}
                          </a>
                          <br>
                          <b>
                              <script>
                                  document.write(new Date().getFullYear())
                              </script>
                          </b>
                      </p>
                  </div>
              </div>
          @endif
      </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
