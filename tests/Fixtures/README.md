Static 2048-bit RSA test keypair used by `CryptoTest`. Not a secret — generated purely for
unit tests, never used against the real API.

Regenerate with:

```bash
openssl genrsa -out test-private.pem 2048
openssl rsa -in test-private.pem -pubout -out test-public.pem
```
