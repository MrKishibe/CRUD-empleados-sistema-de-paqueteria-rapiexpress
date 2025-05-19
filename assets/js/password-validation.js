document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar ambos tipos de campos de contraseña
    const passwordFields = [
        document.querySelector('input[name="password"]'),
        document.querySelector('input[name="newPassword"]')
    ].filter(Boolean); // Filtrar para eliminar nulls si algún campo no existe
    
    passwordFields.forEach(passwordInput => {
        // Agregar clase al input para el selector CSS
        passwordInput.classList.add('password-input');
        
        // Crear el contenedor de validación
        const passwordContainer = passwordInput.closest('.input-group.custom');
        const validationContainer = document.createElement('div');
        validationContainer.className = 'password-validation-container';
        
        // Contenido del validador
        validationContainer.innerHTML = `
            <div class="password-validation-title">
                <i class="icon-copy dw dw-shield"></i>
                Requisitos de contraseña
            </div>
            <ul class="password-validation-list">
                <li id="${passwordInput.name}-length" data-min="8">8+ caracteres</li>
                <li id="${passwordInput.name}-uppercase">1 mayúscula</li>
                <li id="${passwordInput.name}-lowercase">1 minúscula</li>
                <li id="${passwordInput.name}-number">1 número</li>
                <li id="${passwordInput.name}-special">1 especial (!@#$%^&*)</li>
            </ul>
            <div class="password-strength-meter">
                <div class="password-strength-meter-fill" id="${passwordInput.name}-strength-bar"></div>
            </div>
            <div class="password-strength-text" id="${passwordInput.name}-strength-text">Seguridad: muy débil</div>
        `;
        
        // Insertar después del campo de contraseña
        passwordContainer.parentNode.insertBefore(validationContainer, passwordContainer.nextSibling);
        
        // Mostrar/ocultar al hacer focus
        passwordInput.addEventListener('focus', function() {
            validationContainer.classList.add('active');
        });
        
        passwordInput.addEventListener('blur', function() {
            if (this.value === '') {
                validationContainer.classList.remove('active');
            }
        });
        
        // Validar en tiempo real
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            
            if (password.length > 0 && !validationContainer.classList.contains('active')) {
                validationContainer.classList.add('active');
            }
            
            // Validar requisitos individuales
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /[0-9]/.test(password),
                special: /[!@#$%^&*]/.test(password)
            };
            
            // Actualizar visualización de requisitos
            Object.keys(requirements).forEach(key => {
                const element = document.getElementById(`${passwordInput.name}-${key}`);
                if (element) {
                    element.classList.toggle('valid', requirements[key]);
                }
            });
            
            // Calcular fuerza de la contraseña
            updatePasswordStrength(password, requirements, passwordInput.name);
        });
        
        // Función para calcular y mostrar fuerza de la contraseña
        function updatePasswordStrength(password, requirements, fieldName) {
            const strengthBar = document.getElementById(`${fieldName}-strength-bar`);
            const strengthText = document.getElementById(`${fieldName}-strength-text`);
            let strength = 0;
            let fulfilledRequirements = 0;
            
            // Contar requisitos cumplidos
            Object.keys(requirements).forEach(key => {
                if (requirements[key]) fulfilledRequirements++;
            });
            
            // Calcular porcentaje de fuerza
            strength = (fulfilledRequirements / 5) * 100;
            
            // Ajustar fuerza basada en longitud
            if (password.length > 12) strength += 10;
            if (password.length > 16) strength += 10;
            strength = Math.min(strength, 100);
            
            // Actualizar barra de progreso
            strengthBar.style.width = strength + '%';
            
            // Determinar nivel de seguridad
            let strengthLevel = '';
            let strengthColor = '';
            
            if (strength < 40) {
                strengthLevel = 'Muy débil';
                strengthColor = '#e74c3c';
                passwordInput.classList.remove('password-field-medium', 'password-field-strong');
                passwordInput.classList.add('password-field-weak');
            } else if (strength < 75) {
                strengthLevel = 'Moderada';
                strengthColor = '#f39c12';
                passwordInput.classList.remove('password-field-weak', 'password-field-strong');
                passwordInput.classList.add('password-field-medium');
            } else {
                strengthLevel = 'Fuerte';
                strengthColor = '#27ae60';
                passwordInput.classList.remove('password-field-weak', 'password-field-medium');
                passwordInput.classList.add('password-field-strong');
            }
            
            strengthBar.style.backgroundColor = strengthColor;
            strengthText.textContent = `Seguridad: ${strengthLevel}`;
            strengthText.style.color = strengthColor;
        }
    });
    
    // Validar antes de enviar cualquier formulario que contenga estos campos
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            let allValid = true;
            
            passwordFields.forEach(passwordInput => {
                if (form.contains(passwordInput)) {
                    const password = passwordInput.value;
                    const requirements = {
                        length: password.length >= 8,
                        uppercase: /[A-Z]/.test(password),
                        lowercase: /[a-z]/.test(password),
                        number: /[0-9]/.test(password),
                        special: /[!@#$%^&*]/.test(password)
                    };
                    
                    // Verificar si todos los requisitos se cumplen
                    const fieldValid = Object.values(requirements).every(valid => valid);
                    allValid = allValid && fieldValid;
                    
                    if (!fieldValid) {
                        const validationContainer = passwordInput.nextElementSibling;
                        if (validationContainer && validationContainer.classList.contains('password-validation-container')) {
                            validationContainer.classList.add('active');
                            validationContainer.style.animation = 'shake 0.5s';
                            setTimeout(() => {
                                validationContainer.style.animation = '';
                            }, 500);
                        }
                        passwordInput.focus();
                    }
                }
            });
            
            if (!allValid) {
                e.preventDefault();
                alert('Por favor, asegúrate de que todas las contraseñas cumplan con los requisitos.');
            }
        });
    });
});