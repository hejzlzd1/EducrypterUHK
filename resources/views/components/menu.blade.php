<nav id="navbar" class="navbar sticky-top bg-white navbar-expand-lg shadow">
    <div class="container-fluid">
        <div class="logo" style="padding-left: 20px">
            <a class="navbar-brand" href="{{ route('mainPage') }}">
                <img src="{{ asset('img/logo.png') }}" height="50px" alt="Logo uhk"
                     class="logoimg">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggle"
                aria-controls="navbarToggle" aria-expanded="false" aria-label="Menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarToggle" style="padding-right: 20px;">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang("menuTexts.mainPage")
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/#intro">@lang("menuTexts.introInfo")</a></li>
                        <li><a class="dropdown-item" href="/#symmetric">@lang("menuTexts.symmetricAlgo")</a></li>
                        <li><a class="dropdown-item" href="/#asymmetric">@lang("menuTexts.asymmetricAlgo")</a></li>
                        <li><a class="dropdown-item" href="/#usage">@lang("menuTexts.cryptoUsage")</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/#protocols">@lang("menuTexts.protocols")</a></li>
                        <li><a class="dropdown-item" href="/#sslvstls">SSL vs TLS</a></li>
                        <li><a class="dropdown-item" href="/#certificates">@lang("menuTexts.tscertificates")</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang("menuTexts.symmetricAlgo")
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item disabled">@lang('menuTexts.classicCiphers')</li>
                        <li>
                            <a class="dropdown-item"
                               href="{{ route('caesarCipher') }}">@lang('menuTexts.caesarCipher')</a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                               href="{{ route('vigenereCipher') }}">@lang('menuTexts.vigenereCipher')</a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                               href="{{ route('vernamCipher') }}">@lang('menuTexts.vernamCipher')</a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-item disabled">@lang('menuTexts.blockCiphers')</li>
                        <li><a class="dropdown-item" href="{{ route('simpleDesCipher') }}">S-DES</a></li>
                        <li><a class="dropdown-item" href="{{ route('tripleSimpleDesCipher') }}">Triple S-DES</a></li>
                        <li><a class="dropdown-item" href="{{ route('blowfishCipher') }}">Blowfish</a></li>
                        <li><a class="dropdown-item" href="{{ route('simpleAesCipher') }}">S-AES</a></li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-item disabled">@lang("menuTexts.streamCiphers")</li>
                        <li><a class="dropdown-item" href="{{ route('a51') }}">A5/1</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('menuTexts.asymmetricAlgo')
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('diffieHellmanCipher') }}">Diffie-Hellman</a></li>
                        <li><a class="dropdown-item" href="{{ route('rsaCipher') }}">RSA</a></li>
                    </ul>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </div><!-- .navbar -->

    </div>
</nav><!-- End Header -->
