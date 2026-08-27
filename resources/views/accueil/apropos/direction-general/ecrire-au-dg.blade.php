@extends('template')
@section('layout')

<section class="contact-dg">
    <div class="overlay">
        <div class="contact-card">
            <div class="card-header">
                <h1>📩 ÉCRIRE AU DIRECTEUR GÉNÉRAL</h1>
                <p class="subtitle">
                    Votre message sera transmis directement au cabinet de la DGAMP. 
                    Veuillez remplir les informations ci-dessous avec soin.
                </p>
            </div>

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form id="contactForm" action="{{ route('ecrireaudg.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <input type="text" name="name" id="name" placeholder="Nom complet" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="error-msg">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                        @error('email')
                            <p class="error-msg">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" name="subject" id="subject" placeholder="Objet" value="{{ old('subject') }}">
                    @error('subject')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <textarea name="message" id="message" placeholder="Message" rows="4" required>{{ old('message') }}</textarea>
                    @error('message')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-send">
                    <span>Envoyer le message</span>
                </button>
            </form>
        </div>
    </div>
</section>

<style>
/* Appliquer à tous les éléments pour éviter les calculs de taille erronés */
* {
    box-sizing: border-box;
}

.contact-dg {
    min-height: 100vh; /* S'adapte au contenu, ne bloque pas à 100vh */
    width: 100%;
    background: url("assets/images/image7.jpeg") center/cover no-repeat fixed;
    display: flex;
    align-items: center;
    justify-content: center;
}

.overlay {
    background: rgba(0, 0, 0, 0.6);
    width: 100%;
    min-height: 100vh; /* Couvre tout même si on scroll */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px; /* Marge de sécurité pour mobile */
}

.contact-card {
    background: white;
    width: 100%;
    max-width: 500px; /* Ne dépassera jamais 500px */
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.4);
    text-align: center;
    position: relative; /* Pour éviter les bugs de superposition */
}

/* Titre H2 en gras et bien dimensionné */
.contact-card h2 {
    color: #0b1c39;
    margin-bottom: 10px;
    font-size: 24px;
    font-weight: bold;
}

.subtitle {
    font-size: 14px;
    color: #666;
    margin-bottom: 25px;
    font-weight: 600;
    line-height: 1.4;
}

.alert-success {
    background: #22c55e;
    color: #fff;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 600;
}

.error-msg {
    color: #e74c3c;
    font-size: 12px;
    font-weight: 600;
    margin-top: 5px;
    text-align: left;
}

.form-group {
    margin-bottom: 15px;
    width: 100%;
}

.form-group input,
.form-group textarea {
    width: 100%; /* Prend toute la largeur de la carte */
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
    font-size: 14px;
    font-weight: 600;
    display: block; /* Évite les espaces fantômes */
}

.btn-send {
    background: #0b1c39;
    color: white;
    border: none;
    width: 100%; /* Bouton pleine largeur sur mobile */
    padding: 14px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s ease;
}

/* Ajustements pour les petits écrans (Tablettes et Mobiles) */
@media (max-width: 480px) {
    .contact-card {
        padding: 25px 20px;
    }
    .contact-card h2 {
        font-size: 20px;
    }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const card = document.querySelector(".contact-card");
    const inputs = document.querySelectorAll(".form-group input, .form-group textarea");

    // Animation d'entrée élégante
    card.style.opacity = "0";
    card.style.transform = "scale(0.9) translateY(30px)";

    setTimeout(() => {
        card.style.transition = "all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1)";
        card.style.opacity = "1";
        card.style.transform = "scale(1) translateY(0)";
    }, 200);

    // Animation interactive sur les inputs
    inputs.forEach(input => {
        input.addEventListener("focus", () => {
            input.parentElement.style.transform = "translateX(5px)";
            input.parentElement.style.transition = "0.3s";
        });
        input.addEventListener("blur", () => {
            input.parentElement.style.transform = "translateX(0)";
        });
    });
});
</script>

@endsection