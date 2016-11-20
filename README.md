Taxonomy (plugin for Omeka)
===========================

[Taxonomy] is a plugin for [Omeka] that allows to create vocabularies and to
assign them to elements to fill.

Unlike [Simple Vocab], the taxonomies contain a code and a value. This is
specially important to simplify the share and to respect standards, for example
for the list of countries [ISO 3166-1]. Even if the code is saved, it is not
viewable, because the true value is always displayed automatically.

New terms can be added by the admin, and, if allowed, by the user directly in
the main forms for items `admin/items/edit` and collections `admin/collections/edit`.


Installation
------------

Install first [Element Types].

Uncompress files and rename plugin folder "Taxonomy".

Then install it like any other Omeka plugin.


Troubleshooting
---------------

See online issues on the [plugin issues] page on GitHub.


License
-------

This plugin is published under [GNU/GPL v3].

This program is free software; you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation; either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
details.

You should have received a copy of the GNU General Public License along with
this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.


Contact
-------

Current maintainers of the plugin:
* Julian Maurice (see [jajm])


Copyright
---------

* Copyright Julian Maurice for Biblibre, 2015
* Copyright Daniel Berthereau, 2016


[Taxonomy]: https://github.com/biblibre/omeka-plugin-Taxonomy
[Omeka]: https://omeka.org
[Simple Vocab]: https://github.com/omeka/plugin-SimpleVocab
[ISO 3166-1]: http://www.iso.org/iso/country_codes/country_codes
[Element Types]: https://github.com/biblibre/omeka-plugin-ElementTypes
[plugin issues]: https://github.com/biblibre/omeka-plugin-Taxonomy/issues
[GNU/GPL v3]: https://www.gnu.org/licenses/gpl-3.0.html
[jajm]: https://github.com/jajm
[Daniel-KM]: https://github.com/Daniel-KM "Daniel Berthereau"
