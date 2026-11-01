# GitHub deployment

The repository publishes `ghcr.io/<owner>/preciosa-garrido-blog` from GitHub
Actions. Pushes to `release/dev` publish `dev-<commit>` and `latest-dev`.
Tags matching `v*.*.*` publish the semantic version and `latest`.

Create the GitHub environments `dev` and `prd`. Configure each environment
with:

- secret `KUBECONFIG_CI`: kubeconfig with access only to the target namespace;
- variable `K8S_NAMESPACE`: target Kubernetes namespace;
- variable `K8S_DEPLOYMENT`: deployment name;
- variable `K8S_CONTAINER`: container name inside the deployment.

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

`wp-content/uploads` is currently included in the image for migration
compatibility. Production should move uploads to persistent storage or an
object-storage plugin before enabling automated cleanup or horizontal scaling.
