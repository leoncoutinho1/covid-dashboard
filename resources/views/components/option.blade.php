<?PHP
  function compare_name($a, $b)
  {
    return strnatcmp($a->{'Country'}, $b->{'Country'});
  }

  // sort alphabetically by name
  usort($countries, 'compare_name');
?>

<select id=countries onchange="setCountry()">
  @foreach ($countries as $c)
    <option 
      value="{{ $c->{'Slug'} }}"
    >
      {{ $c->{'ISO2'} }} - {{ $c->{'Country'} }}
    </option>
  @endforeach
</select>
    