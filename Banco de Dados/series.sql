
--
-- Database: `series`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho_cupom`
--

CREATE TABLE `carrinho_cupom` (
  `cupom_id` int(11) NOT NULL,
  `cupom_titulo` varchar(255) NOT NULL,
  `cupom_desconto` int(11) NOT NULL,
  `cupom_inicio` datetime NOT NULL,
  `cupom_final` datetime NOT NULL,
  `cupom_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `carrinho_cupom`
--

INSERT INTO `carrinho_cupom` (`cupom_id`, `cupom_titulo`, `cupom_desconto`, `cupom_inicio`, `cupom_final`, `cupom_status`) VALUES
(1, 'DESCONTO10', 10, '2017-01-20 00:00:00', '2017-01-31 00:00:00', 2),
(2, 'VALE50', 50, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho_pedidos`
--

CREATE TABLE `carrinho_pedidos` (
  `pedido_id` int(11) NOT NULL,
  `pedido_produto` int(11) NOT NULL,
  `pedido_quantidade` int(11) NOT NULL,
  `pedido_preco` decimal(10,2) NOT NULL,
  `pedido_valor_total` decimal(10,2) NOT NULL,
  `pedido_cliente` varchar(255) NOT NULL,
  `pedido_data` datetime NOT NULL,
  `pedido_sessao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho_produtos`
--

CREATE TABLE `carrinho_produtos` (
  `produto_id` int(11) NOT NULL,
  `produto_nome` varchar(255) NOT NULL,
  `produto_preco` decimal(10,2) NOT NULL,
  `produto_quantidade` int(11) NOT NULL,
  `produto_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `carrinho_produtos`
--

INSERT INTO `carrinho_produtos` (`produto_id`, `produto_nome`, `produto_preco`, `produto_quantidade`, `produto_img`) VALUES
(1, 'Camisa Vermelha', '120.00', 15, 'camisa-vermelho.png'),
(2, 'Camisa Azul', '100.00', 5, 'camisa-azul.png'),
(3, 'Camisa Xadrez', '120.00', 10, 'camisa-xadrez.png'),
(4, 'Camisa Preta', '110.00', 2, 'camisa-preta.png'),
(5, 'Camisa Clara', '100.00', 12, 'camisa-clara.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho_temporario`
--

CREATE TABLE `carrinho_temporario` (
  `temporario_id` int(11) NOT NULL,
  `temporario_produto` int(11) NOT NULL,
  `temporario_quantidade` int(11) NOT NULL,
  `temporario_preco` decimal(10,2) NOT NULL,
  `temporario_data` datetime NOT NULL,
  `temporario_sessao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `carrinho_temporario`
--

INSERT INTO `carrinho_temporario` (`temporario_id`, `temporario_produto`, `temporario_quantidade`, `temporario_preco`, `temporario_data`, `temporario_sessao`) VALUES
(14, 1, 2, '240.00', '2017-01-21 12:00:13', 41291),
(16, 5, 4, '480.00', '2017-01-21 12:14:24', 41291),
(17, 4, 2, '240.00', '2017-01-21 13:41:16', 41291),
(18, 3, 1, '120.00', '2017-01-21 14:12:17', 41291);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrinho_cupom`
--
ALTER TABLE `carrinho_cupom`
  ADD PRIMARY KEY (`cupom_id`);

--
-- Indexes for table `carrinho_pedidos`
--
ALTER TABLE `carrinho_pedidos`
  ADD PRIMARY KEY (`pedido_id`);

--
-- Indexes for table `carrinho_produtos`
--
ALTER TABLE `carrinho_produtos`
  ADD PRIMARY KEY (`produto_id`);

--
-- Indexes for table `carrinho_temporario`
--
ALTER TABLE `carrinho_temporario`
  ADD PRIMARY KEY (`temporario_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrinho_cupom`
--
ALTER TABLE `carrinho_cupom`
  MODIFY `cupom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `carrinho_pedidos`
--
ALTER TABLE `carrinho_pedidos`
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `carrinho_produtos`
--
ALTER TABLE `carrinho_produtos`
  MODIFY `produto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `carrinho_temporario`
--
ALTER TABLE `carrinho_temporario`
  MODIFY `temporario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
