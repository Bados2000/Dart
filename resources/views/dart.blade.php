@extends('layouts.app')

@section('test')
        <!-- Masthead-->
        <header class="masthead" id="eDart">
            <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="text-center custom-h1">
                        <h1 class="mx-auto my-0 ">eDart</h1>
                        <h2 class="text-white-50 mx-auto mt-2 mb-5">Darmowa platforma dla graczy darta.</h2>
                        <a class="btn btn-primary btn-primary-start href=#about">Zaczynamy</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
{{--        <section class="about-section text-center" id="about">--}}
{{--            <div class="container px-4 px-lg-5">--}}
{{--                <div class="row gx-4 gx-lg-5 justify-content-center">--}}
{{--                    <div class="col-lg-8">--}}
{{--                        <h2 class="text-white mb-4">Built with Bootstrap 5</h2>--}}
{{--                        <p class="text-white-50">--}}
{{--Grayscale is a free Bootstrap theme created by Start Bootstrap. It can be yours right now, simply download the template on--}}
{{--<a href="https://startbootstrap.com/theme/grayscale/">the preview page.</a>--}}
{{--The theme is open source, and you can use it for any purpose, personal or commercial.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <img class="img-fluid img-fluid-fade-edges" src="assets/img/ipad.png" alt="..." />--}}
{{--            </div>--}}
{{--        </section>--}}
        <!-- Projects-->
        <section class="projects-section bg-dark" id="projects">
            <div class="container px-4 px-lg-5">
                <!-- Featured Project Row-->

                    <!-- Featured Project Row-->
                    <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                        <div class="col-xl-4 col-lg-5">
                            <div class="featured-textR text-center text-lg-left">
                                <h4>Graj online</h4>
                                <p class="text-white-50 mb-0">Rywalizuj z darterami z róznych zakątków, sprawdź czy jesteś gotów na prawdziwe wyzwania!</p>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 div-image">
                            <img class="img-fluid mb-3 mb-lg-0" src="assets/img/bg-online.png" alt="..." />
                        </div>
                    </div>
                <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                    <div class="col-xl-8 col-lg-7 div-image">
                        <img class="img-fluid mb-3 mb-lg-0" src="assets/img/bg-online4.png" alt="..." />
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-textL text-center text-lg-left">
                            <h4>Zdobywaj punkty </h4>
                            <p class="text-white-50 mb-0">Awansuj na kolejne poziomy i mierz się z graczami na twoim poziomie!</p>
                        </div>
                    </div>
                </div>
                <!-- Featured Project Row-->
                <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-textR text-center text-lg-left">
                            <h4>Sledź statystyki</h4>
                            <p class="text-white-50 mb-0"> Sprawdź swoją skuteczność, średnią meczową i inne ciekawe informacje !</p>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 div-image">
                        <img class="img-fluid mb-3 mb-lg-0" src="assets/img/bg-online3.png" alt="..." />
                    </div>
                </div>

            </div>
        </section>
        <section class="autosystem-section bg-dark" id="autosystem">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-10 text-center">
                        <h2>System automatycznego zliczania punktów</h2>
                        <p class="text-white-50 mb-0"> Chcesz zautomatyzować gre, a może liczenie nie jest twoją mocną stroną ?</p>
                        <img class="img-fluid mb-3 mb-lg-0 centered-image" src="assets/img/bg-online5.png" alt="..." />
                        <p class="text-white-50 mb-0"> Specjalnie dla Ciebie przygotowaliśmy urządzenie wraz z oprogramowaniem, które po jednorazowej konfiguracji będzie w pełni kompatybilne z naszą stroną. </p>
                        <p class="text-white-50 mb-0"> Napisz do nas, a prześlemy Ci aktualną ofertę. </p>
                    </div>

                </div>
            </div>
        </section>

        <section class="signup-section" id="signup">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-10 col-lg-8 mx-auto text-center">
                        <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                        <h2 class="text-white mb-5">Wyślij nam swój email, a sami się odwezwiemy !</h2>
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form class="form-signup" id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Email address input-->
                            <div class="row input-group-newsletter">
                                <div class="col"><input class="form-control" id="emailAddress" type="email" placeholder="Wprowadź adres email..." aria-label="Enter email address..." data-sb-validations="required,email" /></div>
                                <div class="col-auto"><button class="btn btn-primary disabled" id="submitButton" type="submit">Wyślij!</button></div>
                            </div>
                            <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:required">An email is required.</div>
                            <div class="invalid-feedback mt-2" data-sb-feedback="emailAddress:email">Email is not valid.</div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3 mt-2 text-white">
                                    <div class="fw-bolder">Form submission successful!</div>
To activate this form, sign up at
<br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3 mt-2">Error sending message!</div></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact-->
        <section class="contact-section bg-black">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Address</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50">ANS Cieniawa, POLSKA</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Email</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50"><a href="#!">eDart@wp.pl</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Phone</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50">+48 123 456 789</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social d-flex justify-content-center">
                    <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </section>
@endsection
