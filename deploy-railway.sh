#!/bin/bash
# Script para preparar el proyecto para Railway

echo "🚀 Preparando proyecto para Railway..."

# Verificar si git está inicializado
if [ ! -d ".git" ]; then
    echo "📁 Inicializando repositorio Git..."
    git init
    git branch -M main
fi

# Agregar archivos al stage
echo "📋 Agregando archivos..."
git add .

# Crear commit
echo "💾 Creando commit..."
git commit -m "feat: Configuración inicial para Railway

- Agregados archivos de configuración para Railway
- Configurada base de datos con variables de entorno
- Configurado build process con Gulp
- Agregada documentación de deployment"

echo "✅ Proyecto preparado para Railway!"
echo ""
echo "📋 Próximos pasos:"
echo "1. Crea un repositorio en GitHub"
echo "2. Conecta con: git remote add origin [URL_DEL_REPO]"
echo "3. Sube el código: git push -u origin main"
echo "4. Ve a Railway.app y conecta tu repositorio"
echo "5. Configura las variables de entorno según RAILWAY_DEPLOY.md"
echo ""
