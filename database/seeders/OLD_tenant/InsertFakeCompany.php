<?php

namespace Database\Seeders\Tenant;

// database/seeders/CarDealershipSeeder.php

use App\Models\Company;
use App\Models\CompanyCredential;
use App\Models\CompanyPersonalInfos;
use App\Models\CompanyProfile;
use App\Models\Product;
use Illuminate\Database\Seeder;

class InsertFakeCompany extends Seeder
{
    public function run()
    {
        // Criação da Empresa
        $company = CompanyPersonalInfos::create([
            'name'      => 'AutoElite - Veículos Premium',
            'cnpj'     => '12345678000199', // CNPJ fictício
            'legal_email' => 'vendas@autoelite.com.br',
            'phone'     => '+55 (11) 98765-4321',
            'address'   => 'Avenida das Nações Unidas, 1234 - São Paulo/SP',
        ]);

        // Credenciais da Empresa (Dados Confidenciais)
        CompanyCredential::create([
            'company_personal_info_id'     => $company->id,
            'api_token'      => 'AEEBkZ4aXl6enp6QURFRA==', // Token fictício
            'admin_password' => bcrypt('SenhaSegura@2024'),
            'bank_account'   => 'Banco XYZ | Agência 0001 | Conta 987654-3',
        ]);

        // Perfil Descritivo da Empresa
        CompanyProfile::create([
            'company_personal_info_id'       => $company->id,
            'description'      => 'A AutoElite é especializada em veículos premium seminovos e novos, com rigoroso processo de inspeção. Oferecemos garantia de 12 meses, financiamento direto e entrega nacional.',
            'products_services' => 'Venda de carros de luxo, consórcio, avaliação de usados, seguro automotivo e personalização de veículos.',
            'mission'          => 'Fornecer veículos de alto padrão com transparência e excelência no atendimento.',
            'vision'           => 'Ser referência nacional em vendas de veículos premium até 2028.',
            'values'           => 'Integridade, Qualidade, Inovação',
            'social_links'     => json_encode([
                'website' => 'https://www.autoelite.com.br',
                'instagram' => '@autoelite_oficial',
                'facebook' => 'facebook.com/autoelite'
            ]),
        ]);

        // Produtos (Carros para Venda)
        $cars = [
            [
                'name' => 'Audi Q8 2023',
                'description' => 'Audi Q8 2023, 15.000 km, Branco. Motor 3.0 TFSI, 340 cv. 
                                 Tecnologia Matrix LED, interior em couro Valcona, teto solar panorâmico. 
                                 Único dono, revisões na concessionária.',
                'price' => 569000.00,
                'category' => 'SUV',
                'tags' => ['tecnologia', 'conforto', 'seminovo'],
                'is_available' => true,
            ],
            [
                'name' => 'Tesla Model S Plaid 2024',
                'description' => 'Tesla Model S Plaid 2024, 0 km, Preto. Aceleração 0-100 km/h em 2.1 segundos. 
                                 Autonomia de 600 km, tela central de 17", piloto automático Full Self-Driving. 
                                 Entrega imediata com garantia de 8 anos.',
                'price' => 1299000.00,
                'category' => 'Elétrico',
                'tags' => ['elétrico', 'alto-desempenho', 'tecnologia'],
                'is_available' => true,
            ],
            [
                'name' => 'Jeep Wrangler Rubicon 2023',
                'description' => 'Jeep Wrangler Rubicon 2023, 10.000 km, Vermelho. Motor 2.0 Turbo, 270 cv. 
                                 Pack Off-Road com bloqueio de diferencial, cabine removível, rodas aro 17". 
                                 Ideal para trilhas e aventuras.',
                'price' => 429000.00,
                'category' => 'Off-Road',
                'tags' => ['aventura', 'customizavel', 'seminovo'],
                'is_available' => true,
            ],
            [
                'name' => 'Ferrari F8 Tributo 2022',
                'description' => 'Ferrari F8 Tributo 2022, 8.500 km, Amarelo. Motor V8 biturbo, 720 cv. 
                                 Aerodinâmica ativa, bancos esportivos em carbono, sistema de escapamento esportivo. 
                                 Laudo cautelar e histórico de manutenção.',
                'price' => 2899000.00,
                'category' => 'Supercarro',
                'tags' => ['colecionador', 'luxo', 'esportivo'],
                'is_available' => true,
            ],
            [
                'name' => 'BMW X5 2022',
                'description' => 'SUV BMW X5 2022, 35.000 km, cor Preta Fosco. Motor 3.0 TwinPower Turbo a gasolina, 333 cv. 
                                 Interior em couro Merino com acabamento em madeira, teto solar panorâmico, sistema de som Harman Kardon. 
                                 Revisões feitas na concessionária. Único dono, sem sinistro.',
                'price' => 489900.00,
                'category' => 'SUV',
                'tags' => ['luxo', 'seminovo', 'baixa-kilometragem'],
                'is_available' => true,
            ],
            [
                'name' => 'Mercedes-Benz Classe C 2023',
                'description' => 'Mercedes Classe C 2023, 12.000 km, cor Prata. Motor 2.0 Turbo com hibridização leve, 258 cv. 
                                  Tela multimídia de 11,9", assistente de direção autônoma, bancos com massageamento. 
                                  Garantia de fábrica até 2026. Financiamento em até 60x.',
                'price' => 379900.00,
                'category' => 'Sedan',
                'tags' => ['tecnologia', 'garantia-estendida', 'lançamento'],
                'is_available' => true,
            ],
            [
                'name' => 'Porsche 911 Carrera S 2021',
                'description' => 'Porsche 911 Carrera S 2021, 18.500 km, Vermelho. Motor 3.0 boxer twin-turbo, 450 cv. 
                                 Pacote Sport Chrono, rodas aro 20", freios cerâmicos, modo de condução Sport Plus. 
                                 Documentação em dia e laudo cautelar incluso.',
                'price' => 1299900.00,
                'category' => 'Esportivo',
                'tags' => ['esportivo', 'alto-desempenho', 'colecionador'],
                'is_available' => true,
            ],
            [
                'name' => 'Land Rover Defender 2024',
                'description' => 'Land Rover Defender 2024, 0 km, Verde Oxford. Motor 3.0 Diesel, 300 cv. 
                                 Pack Off-Road com altura ajustável, tração 4x4, teto removível. 
                                 Entrega imediata e personalização de acessórios.',
                'price' => 899000.00,
                'category' => 'Off-Road',
                'tags' => ['novo', 'off-road', 'personalizavel'],
                'is_available' => true,
            ],
            [
                'name' => 'Rolls-Royce Phantom 2023',
                'description' => 'Edição Bespoke 2023, 500 km, Branco Estrelar. Motor V12 6.75L, 563 cv. 
                                 Interior personalizado com fibra de carbono e ouro 24k, teto estrelado, 
                                 sistema de som 3D com 18 alto-falantes. Entrega com champagne Louis Roederer.',
                'price' => 18999900.00,
                'category' => 'Ultra-Luxo',
                'tags' => ['personalizado', 'exclusivo', 'arte'],
                'is_available' => true,
            ],
            [
                'name' => 'Tesla Cybertruck 2024',
                'description' => 'Primeira edição Foundation Series, 0 km, Aço escovado. Tri-motor AWD, 845 cv. 
                                 Blindagem nível 9, autonomia de 720 km, carregamento solar. 
                                 Suspensão pneumática adaptativa para off-road extremo.',
                'price' => 4590000.00,
                'category' => 'Elétrico',
                'tags' => ['futurista', 'off-road', 'tecnologia'],
                'is_available' => false,
            ],
            [
                'name' => 'Ferrari Daytona SP3 2024',
                'description' => 'Limited Edition #12/599, 0 km, Rosso Corsa. Motor V12 6.5L 840 cv. 
                                 Chassis monocasco em fibra de carbono, aerodinâmica ativa, 
                                 sistema de escapamento em titânio. Certificado de autenticidade Ferrari Classiche.',
                'price' => 32950000.00,
                'category' => 'Hypercar',
                'tags' => ['colecionador', 'investimento', 'competição'],
                'is_available' => true,
            ],
            [
                'name' => 'Bentley Flying Spur Hybrid 2025',
                'description' => '2025, 0 km, Verde British Racing. Motor 3.0 V6 + elétrico, 536 cv. 
                                 Interior em madeira Crown Cut Walnut, assentos massageadores com 22 ajustes, 
                                 sistema de ar purificado Naim for Bentley. Emissão zero em modo elétrico.',
                'price' => 6890000.00,
                'category' => 'Híbrido',
                'tags' => ['sustentável', 'conforto', 'tecnologia'],
                'is_available' => true,
            ],
            [
                'name' => 'McLaren Sabre 2024',
                'description' => 'Produção limitada (15 unidades), 0 km, Laranja Volcano. Motor V8 4.0L twin-turbo 824 cv. 
                                 Aerofólio ativo com sistema track mode, bancos monocasco em carbono, 
                                 telemetria profissional integrada. Performance 0-300 km/h em 16.7s.',
                'price' => 59900000.00,
                'category' => 'Supercarro',
                'tags' => ['track-ready', 'exclusivo', 'desempenho'],
                'is_available' => true,
            ],
            [
                'name' => 'Aston Martin Valkyrie AMR Pro 2024',
                'description' => 'Versão track-only, 0 km, Verde Aston Martin. Motor V12 6.5L 1160 cv. 
                                 Chassis em fibra de carbono com estrutura honeycomb, aerodinâmica com 2000kg de downforce, 
                                 sistema de recuperação de energia KERS. Entrega com treinamento na F1 Driving Academy.',
                'price' => 89900000.00,
                'category' => 'Competição',
                'tags' => ['f1', 'leve', 'downforce'],
                'is_available' => true,
            ],
            [
                'name' => 'Pagani Huayra R 2024',
                'description' => 'Edição comemorativa 25 anos Pagani, 0 km, Azul Zanzibar. Motor V12 6.0L 850 cv. 
                                 Carroceria em carbotanium, sistema de escapamento termocrômico, 
                                 interior em alumínio avional forjado a mão. Certificado de procedência Pagani.',
                'price' => 75900000.00,
                'category' => 'Obra de Arte',
                'tags' => ['handmade', 'exclusivo', 'artesanato'],
                'is_available' => true,
            ],
            [
                'name' => 'Lamborghini Revuelto 2025',
                'description' => 'Primeiro híbrido da Lamborghini, 0 km, Arancio Atlas. Motor V12 6.5L + 3 motores elétricos, 1015 cv. 
                                 Sistema de tração vectorial, modo Corsa com ajuste de oversteer, 
                                 carregamento rápido em 30min. Design inspirado em caças stealth.',
                'price' => 12900000.00,
                'category' => 'Híbrido',
                'tags' => ['hibrido', 'agressivo', 'inovação'],
                'is_available' => true,
            ],
            [
                'name' => 'Koenigsegg Jesko Absolut 2024',
                'description' => 'Versão velocidade máxima, 0 km, Prata Liquid Metal. Motor V8 5.0L twin-turbo 1600 cv (E85). 
                                 Aerodinâmica otimizada para 531 km/h, pneus Michelin UHP Cup 2R, 
                                 sistema de redução de arrasto ativo. Teste de velocidade incluso na Suécia.',
                'price' => 65900000.00,
                'category' => 'Hypercar',
                'tags' => ['velocidade', 'record', 'biofuel'],
                'is_available' => true,
            ],
            [
                'name' => 'Bugatti Chiron Super Sport 300+',
                'description' => 'Edição limitada (30 unidades), 0 km, Carbon Fiber Exposed. Motor W16 8.0L quad-turbo 1600 cv. 
                                 Pacote Speed Key para desbloquear 490 km/h, aerofólios em fibra de diamante, 
                                 sistema de refrigeração track-focused. Certificado de recorde mundial de velocidade.',
                'price' => 459000000.00,
                'category' => 'Hypercar',
                'tags' => ['record', 'exclusivo', 'potência'],
                'is_available' => false,
            ]
        ];

        foreach ($cars as $car) {
            Product::create([
                'name' => $car['name'],
                'description' => $car['description'],
                'price' => $car['price'],
                'category' => $car['category'],
                'tags' => $car['tags'],
                'is_available' => $car['is_available'],
            ]);
        }
    }
}
