# DokuWiki-Plugin: SendHTML

Sends a (rendered) DokuWiki-Document per E-Mail.

Originally forked from [SendPageContent-Plugin](http://dokuwiki.org/plugin:sendpagecontent) by Matthias Schulte

## Usage

Send a E-Mail by using the GET-Parameter ``sendhtml=<email-adress>``, e.g.

```
www.yourdomain.com/doku.php?id=start&sendhtml=youremail@example.com
```

Use ``{{MAIL:<email>,<label>}}`` to create a link. The ``<label>`` is optional.

Examples:

```
{{MAIL:test@domain.com}}
{{MAIL:test@domain.com,The label}}
```