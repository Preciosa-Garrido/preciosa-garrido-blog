# Preciosa Garrido Blog

WordPress application for Preciosa Garrido. The repository intentionally
contains only application-owned code and deployment configuration.

## What is versioned

- the custom `preciosagarrido` theme;
- exact third-party plugin versions in `composer.lock`;
- the production Docker image definition;
- CI/CD workflows and deployment documentation.

WordPress core is supplied by the pinned official container image. Plugins are
installed by Composer. Uploads, database content, generated caches, and
`wp-config.php` are runtime state and must not be committed.

## Local development

Run the Compose project from the sibling `preciosa-garrido` repository:

```sh
docker compose up --build
```

The custom theme and uploads are mounted from this working tree for local
development. See `DEPLOYMENT.md` for GitHub and Kubernetes configuration.
* Other community or team contact
