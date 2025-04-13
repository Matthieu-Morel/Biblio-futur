        <main class="flex-grow-1" style="background-color: #dddddd;">
            <h1 class="display-5 text-center mb-3">Connexion</h1>
            <form class="container w-50 p-3 border border-secondary rounded" action="" method="post">
                <div class="mb-3">
                    <label for="mail" class="form-label">Adresse mail</label>
                    <input name="login" type="email" class="form-control" id="mail" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input name="password" type="password" class="form-control" id="password" required>
                </div>
                <button class="btn btn-info" type="submit">Se connecter</button>
            </form>
            <div class="container w-50">
                <p>Si vous n'avez pas de compte, vous pouvez vous <a href="./?page=inscription" type="submit">inscrire</a>.</p>
            </div>
        </main>