This spec is obtained from OpenSSH BSD File Formats Manual `SSH_CONFIG(5)`

> For each parameter, the first obtained value will be used. The configuration files contain sections separated by `Host` specifications, and that section is only applied for hosts that match one of the patterns given in the specification.
>
> Since the first obtained value for each parameter is used, more host-specific declarations should be given near the beginning of the file, and general
> defaults at the end.
>
> The configuration file has the following format:
>
> Empty lines and lines starting with `#` are comments. Otherwise a line is of the format `keyword arguments`. Configuration options may be separated by whitespace or optional whitespace and exactly one `=`; the latter format is useful to avoid the need to quote whitespace when specifying configuration options using the ssh, scp, and sftp `-o` option. Arguments may optionally be enclosed in double quotes (`"`) in order to represent arguments containing spaces.
>
> A pattern consists of zero or more non-whitespace characters, `*` (a wildcard that matches zero or more characters), or `?` (a wildcard that matches exactly one character). For example, to specify a set of declarations for any host in the `.co.uk` set of domains, the following pattern could be used:
>
> ```
> Host *.co.uk
> ```
>
> The following pattern would match any host in the `192.168.0.[0-9]` network range:
>
> ```
> Host 192.168.0.?
> ```
>
> A pattern-list is a comma-separated list of patterns. Patterns within pattern-lists may be negated by preceding them with an exclamation mark (`!`). For example, to allow a key to be used from anywhere within an organization except from the `dialup` pool, the following entry (in `authorized_keys`) could be used:
>
> ```
> from="!*.dialup.example.com,*.example.com"
> ```
