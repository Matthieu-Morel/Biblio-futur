        <main class="flex-grow-1" style="background-color: #dddddd;">
            <h1 class="display-5 text-center mb-3">Inscription</h1>
            <form class="container w-50 p-3 border border-secondary rounded" action="" method="post">
                <div class="mb-3">
                    <label for="firstName" class="form-label">Prénom</label>
                    <input name="firstName" type="text" class="form-control" id="firstName" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Nom</label>
                    <input name="lastName" type="text" class="form-control" id="lastName" required>
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Adresse mail</label>
                    <input name="login" type="email" class="form-control" id="mail" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input name="password" type="password" class="form-control" id="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirmation du mot de passe</label>
                    <input name="confirmPassword" type="password" class="form-control" id="confirmPassword" required>
                </div>
                <button class="btn btn-info" type="submit">S'inscrire</button>
            </form>
            <div class="container w-50">
                <p>Si vous avez un compte, vous pouvez vous <a href="./?page=connexion" type="submit">connecter</a>.</p>
            </div>
        </main>