# GitHub deployment

The repository publishes `ghcr.io/<owner>/preciosa-garrido-blog` from GitHub
Actions. Pushes to `dev` publish `dev-<commit>` and `latest-dev`.
Tags matching `v*.*.*` publish the semantic version and `latest`.

Create the GitHub environments `dev` and `prd`. Configure each environment
with:

- secret `KUBECONFIG_CI`: kubeconfig with access only to the target namespace;
- variable `K8S_NAMESPACE`: target Kubernetes namespace;
- variable `K8S_DEPLOYMENT`: deployment name;
- variable `K8S_CONTAINER`: container name inside the deployment.

Set the repository variable `DEPLOY_ENABLED` to `true` only after both
environments are configured. Until then, the workflow publishes the GHCR image
and skips Kubernetes deployment instead of failing.

The cluster also needs an image pull secret for the private GHCR package. A
GitHub classic personal access token with `read:packages` is sufficient:

```sh
kubectl create secret docker-registry ghcr \
  --docker-server=ghcr.io \
  --docker-username=<github-user> \
  --docker-password=<token> \
  --namespace=<namespace>
```

Reference that secret from the workload's `imagePullSecrets`. The CI workflow
publishes with the repository-scoped `GITHUB_TOKEN`; no separate push token is
required.

The image contains a pinned WordPress release, locked third-party plugin
versions, and the custom theme. It does not contain runtime configuration or
uploads.

Provide WordPress configuration through environment variables supported by the
official image, including `WORDPRESS_DB_HOST`, `WORDPRESS_DB_NAME`,
`WORDPRESS_DB_USER`, and `WORDPRESS_DB_PASSWORD`. Keep authentication salts in
Kubernetes secrets rather than in Git.

Configure all eight stable authentication values as secrets so that container
restarts do not invalidate active sessions: `WORDPRESS_AUTH_KEY`,
`WORDPRESS_SECURE_AUTH_KEY`, `WORDPRESS_LOGGED_IN_KEY`, `WORDPRESS_NONCE_KEY`,
`WORDPRESS_AUTH_SALT`, `WORDPRESS_SECURE_AUTH_SALT`,
`WORDPRESS_LOGGED_IN_SALT`, and `WORDPRESS_NONCE_SALT`. Generate new values for
the first deployment of this image; the old values were previously committed.

Core, plugin, and theme changes through wp-admin are disabled in the image.
Updates must change the pinned image or `composer.lock`, pass CI, and be
deployed through the normal release workflow.

Mount `wp-content/uploads` from persistent storage or configure an
object-storage plugin before deploying. All replicas must see the same media.
