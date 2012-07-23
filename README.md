#EmailFilterBundle

This bundle check if an email or a domain is valid or not.

##Documentation

The bulk of the documentation is stored in the Resources/doc/index.md.

### Configuration

Add the following to your application's `config.yml`.

```
fsc_standalone_email_filter:
    file: "%kernel.root_dir%/Resources/emails_filter.txt"
```

And create your `app/Resources/emails_filter.txt` with the following format:

```
you.can.ban.a.single.mail@gmail.com
@yopmail.fr
shitmailprovider.com
```

##License

This bundle is under the MIT license. See the complete license in the bundle:

Resources/meta/LICENSE
