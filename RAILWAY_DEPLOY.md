# 🚀 Desplegar PearOS Sulaiman en Railway

## Pasos para Desplegar:

### 1. Preparar el Repositorio
```bash
git add .
git commit -m "Configuración para Railway"
git push origin main
```

### 2. Configurar Variables de Entorno en Railway
En el panel de Railway, agregar estas variables:

```
DB_HOST=mysql-sulaiman.alwaysdata.net
DB_NAME=sulaiman_crud_uf3
DB_USER=sulaiman_
DB_PASSWORD=APTItude01
APP_ENV=production
PORT=8080
```

### 3. Configurar Build Command (Opcional)
Si Railway no detecta automáticamente:
- **Build Command**: `npm install && npm run build`
- **Start Command**: `php -S 0.0.0.0:$PORT -t theme/`

### 4. Configurar Dominio Personalizado
1. Ve a Settings > Domains
2. Agrega tu dominio personalizado
3. Configura los DNS según las instrucciones

## Problemas Comunes y Soluciones:

### ❌ Error de Conexión a Base de Datos
- Verificar que las variables de entorno estén correctamente configuradas
- Asegurar que la base de datos externa sea accesible desde Railway

### ❌ Error de Archivos de Upload
- Los archivos subidos se almacenan temporalmente
- Para persistencia, configurar un volumen en Railway o usar servicio externo como Cloudinary

### ❌ Error de Rutas PHP
- Verificar que todas las rutas usen paths relativos
- Comprobar que el directorio `theme/` sea el root

### ❌ Error de Sesiones PHP
- Las sesiones pueden perderse entre deployments
- Considerar usar Redis para sesiones persistentes

## Optimizaciones para Producción:

1. **Configurar HTTPS**: Railway proporciona SSL automático
2. **Optimizar Base de Datos**: Asegurar índices correctos
3. **CDN para Assets**: Mover imágenes estáticas a CDN
4. **Monitoring**: Configurar logs y métricas

## Comandos Útiles:

```bash
# Ver logs en tiempo real
railway logs

# Conectar a la base de datos
railway connect

# Ejecutar comandos remotos
railway run php -v
```

## 🔧 Archivos de Configuración Creados:

- `composer.json` - Dependencias PHP
- `Procfile` - Comando de inicio
- `nixpacks.toml` - Configuración de build
- `.env.example` - Variables de entorno ejemplo
- `config/upload_config.php` - Configuración de uploads
