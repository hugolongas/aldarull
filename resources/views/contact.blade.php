@extends('layouts.master', ['body_class' => 'contact']) 
@section('content')
<section id="contact">
    <h1 class="section-title">CONTACTE</h1>
    <div class="center-section">
        <div class="contact-container">
            <div class="col-sm-12 col-md-4">
                <div class="contractacio">
                    <div class="info-contractacio">
                        <h4>Contractació directa</h4>
                        <div class="info">
                            Teléfon: <span>{!!Resources::GetResource('footer.telefon')!!}</span><br/> E-mail: <span>{!!Resources::GetResource('footer.email')!!}</span>
                        </div>
                    </div>
                    <div class="xarxes-socials">
                        <h4>Xarxes Socials</h4>
                        <div class="social">
                            <a href="https://www.facebook.com/Aldarull-Grup-1238683506180613" alt="facebook-aldarull" target="_blank">
                            <img src="{{ asset('img/black_facebook.png') }}" class="img-fluid"/>
                        </a>
                        </div>
                        <div class="social">
                            <a href="https://www.instagram.com/aldarull_grup/" alt="instagram-aldarull" target="_blank">
                                <img src="{{ asset('img/black_instagram.png') }}" class="img-fluid" />
                            </a>
                        </div>
                        <div class="social">
                            <a href="https://www.youtube.com/channel/UCJynQj7HktHfa5UpvmZ8e-g" alt="youtube-aldarull" target="_blank">
                                <img src="{{ asset('img/black_youtube.png') }}"  class="img-fluid"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div id="response"></div>
                <form id="contact-form">
                    <meta name="_token" content="{{ csrf_token() }}">
                    <div class="form-group">
                        <input type="text" class="form-control" id="contact_name" name="name" placeholder="Nom Complert" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="contact_email" name="email" placeholder="introdueixi un e-mail vàlid" required>
                    </div>

                    <div class="form-group">
                        <textarea class="textarea form-control" id="contact_message" name="message" placeholder="missatge" required></textarea>
                    </div>
                    <div class="form-check">
                        <label class="container">En fer clic accepto la política de privacitat
                    <input type="checkbox" class="form-check-input" id="politica" name="politica" required>
                    <span class="checkmark"></span>
                  </label>
                    </div>
                    <button type="submit" id="submit_contact" class="btn btn-aldarull">Enviar</button>
                </form>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="gdpr-container">
                    <div class="gdpr-title">Informació bàsica sobre protecció de dades</div>
                    <div class="gdpr-title">Responsable: <span class="gdpr-info">Aldarull</span></div>
                    <div class="gdpr-title">Finalitat: <span class="gdpr-info">Enviament d'informació sol·licitada</span></div>
                    <div class="gdpr-title">Legitimació: <span class="gdpr-info">Consentiment de l'interesstat</span></div>
                    <div class="gdpr-title">Destinatari: <span class="gdpr-info">Hosting com a plataforma de recepció d'e-mails</span></div>
                    <div class="gdpr-title">Drets: <span class="gdpr-info">A accedir, rectificar i eliminar les dades</span></div>
                    <div class="gdpr-title">Informació addicional: <span class="gdpr-info">Disponible la informació sobre la protecció de dades personals de la web "aldarull" en <a href="politica.html">+info</a></span></div>
                </div>
            </div>
        </div>
    </div>
    <div id="loading">
        <img class="img-fluid" src="{{ asset('img/loading.gif') }}" alt="loading">
    </div>
</section>
@endsection