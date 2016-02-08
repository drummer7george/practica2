----pais
insert into pais(nombre)
select distinct pais from datos

--region
insert into region(nombre)
select distinct region from datos
order by region asc

--departamento
insert into departamento(nombre,pais,region)
select distinct trim(da.departamento) otro, pa.id_pais,re.id_region from datos da,pais pa, region re
where da.pais=pa.nombre and re.nombre=da.region
order by otro

--partido
insert into partido(nombre,partido,pais)
select distinct da.nombre_partido, da.partido, pa.id_pais from datos da, pais pa
where da.pais=pa.nombre
order by da.nombre_partido

--municipio
insert into municipio(nombre,departamento)
select distinct da.municipio, de.id_depto from datos da, departamento de
where trim(da.departamento)=de.nombre
order by da.municipio

--eleccion
insert into eleccion(tipo)
select distinct trim(da.nombre_eleccion) from datos da

--raza
insert into raza(nombre)
select distinct da.raza from datos da
order by da.raza

-- erpm

insert into erpm(anio,sexo,analfabetos,alfabetos,primaria,n_medio,universitario,partido,municipio,eleccion,raza)
select distinct da.anio_eleccion::integer anio,da.sexo,da.analfabetos::integer,da.alfabetos::integer,da.primaria::integer,da.n_medio::integer,da.universitario::integer,par.id_partido,
mun.id_municipio, ele.id_eleccion,ra.id_raza
from datos da, partido par, municipio mun, eleccion ele, raza ra,departamento dep,region reg,pais pa
where da.sexo=da.sexo2 and da.municipio=mun.nombre and mun.departamento=dep.id_depto and trim(da.departamento)=dep.nombre
and dep.region=reg.id_region and reg.nombre=da.region and dep.pais=pa.id_pais and pa.nombre=da.pais and 
 ele.tipo=da.nombre_eleccion and par.nombre=da.nombre_partido and par.partido=da.partido and da.raza=da.raza2 and 
da.raza=ra.nombre 
order by anio

 